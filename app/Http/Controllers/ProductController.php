<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PricePlan;
use App\Models\Media;
use App\Models\Seo;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withCount('pricePlans')->ordered()->paginate(10);
        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.pages.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'title',
            'subtitle',
            'description',
            'type',
            'price',
            'buy_link',
            'icon',
            'sort_order',
            'status'
        ]);

        // Handle OG image
        $ogImagePath = null;
        if ($request->hasFile('meta_image')) {
            $ogImagePath = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        $product = Product::create($data);

        // Create SEO record
        $product->seo()->create([
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $ogImagePath,
        ]);

        // Handle Price Plans
        if ($request->has('plans')) {
            foreach ($request->plans as $planData) {
                if (!empty($planData['name'])) {
                    $product->pricePlans()->create([
                        'name' => $planData['name'],
                        'price' => $planData['price'],
                        'duration' => $planData['duration'],
                        'features' => $planData['features'],
                        'is_popular' => isset($planData['is_popular']) ? 1 : 0,
                        'sort_order' => $planData['sort_order'] ?? 0,
                        'status' => $planData['status'] ?? 1,
                    ]);
                }
            }
        }

        // Handle Media uploads
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $product->id)
                ->where('model_type', Product::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');

                Media::create([
                    'model_type' => Product::class,
                    'model_id'   => $product->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $product->title,
                    'size'       => $size,
                    'is_main'    => !$hasDefault && $key === 0,
                    'created_by' => auth()->id(),
                ]);
                $hasDefault = true; // Set to true after first upload
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::with(['pricePlans', 'media', 'seo'])->findOrFail($id);
        return view('backend.pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'title',
            'subtitle',
            'description',
            'type',
            'price',
            'buy_link',
            'icon',
            'sort_order',
            'status'
        ]);

        // Handle OG image
        $ogImagePath = $product->seo->og_image ?? null;
        if ($request->hasFile('meta_image')) {
            if ($ogImagePath) {
                ImageHelper::deleteImage($ogImagePath);
            }
            $ogImagePath = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        $product->update($data);

        // Prepare SEO data
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $ogImagePath,
        ];

        if ($product->seo) {
            $product->seo->update($seoData);
        } else {
            $product->seo()->create($seoData);
        }

        // Sync Price Plans
        if ($request->has('plans')) {
            $existingPlanIds = $product->pricePlans->pluck('id')->toArray();
            $updatedPlanIds = [];

            foreach ($request->plans as $planData) {
                if (!empty($planData['name'])) {
                    if (isset($planData['id']) && in_array($planData['id'], $existingPlanIds)) {
                        $plan = PricePlan::find($planData['id']);
                        $plan->update([
                            'name' => $planData['name'],
                            'price' => $planData['price'],
                            'duration' => $planData['duration'],
                            'features' => $planData['features'],
                            'is_popular' => isset($planData['is_popular']) ? 1 : 0,
                            'sort_order' => $planData['sort_order'] ?? 0,
                            'status' => $planData['status'] ?? 1,
                        ]);
                        $updatedPlanIds[] = $plan->id;
                    } else {
                        $newPlan = $product->pricePlans()->create([
                            'name' => $planData['name'],
                            'price' => $planData['price'],
                            'duration' => $planData['duration'],
                            'features' => $planData['features'],
                            'is_popular' => isset($planData['is_popular']) ? 1 : 0,
                            'sort_order' => $planData['sort_order'] ?? 0,
                            'status' => $planData['status'] ?? 1,
                        ]);
                        $updatedPlanIds[] = $newPlan->id;
                    }
                }
            }
            $plansToDelete = array_diff($existingPlanIds, $updatedPlanIds);
            PricePlan::destroy($plansToDelete);
        } else {
            $product->pricePlans()->delete();
        }

        // Handle main image selection
        if ($request->filled('is_main')) {
            Media::where('model_id', $product->id)
                ->where('model_type', Product::class)
                ->update(['is_main' => false]);
 
            if (str_starts_with($request->is_main, 'new_')) {
                $newMainFlag = true;
            } else {
                Media::where('id', $request->is_main)
                    ->where('model_id', $product->id)
                    ->where('model_type', Product::class)
                    ->update(['is_main' => true]);
            }
        }

        // Handle Media deletion
        if ($request->filled('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->model_id == $product->id && $media->model_type == Product::class) {
                    ImageHelper::deleteImage($media->path);
                    $media->delete();
                }
            }
        }

        // Handle Media uploads (Gallery)
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $product->id)
                ->where('model_type', Product::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $isMain = (!$hasDefault && $key === 0) || (isset($newMainFlag) && $newMainFlag);
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');
 
                Media::create([
                    'model_type' => Product::class,
                    'model_id'   => $product->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $product->title,
                    'size'       => $size,
                    'is_main'    => $isMain,
                    'created_by' => auth()->id(),
                ]);
                if ($isMain) {
                    $hasDefault = true;
                    $newMainFlag = false;
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::with(['media', 'seo'])->findOrFail($id);

        if ($product->seo && $product->seo->og_image) {
            ImageHelper::deleteImage($product->seo->og_image);
            $product->seo()->delete();
        }

        foreach ($product->media as $media) {
            ImageHelper::deleteImage($media->path);
            $media->delete();
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
