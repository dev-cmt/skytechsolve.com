<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Feature;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use App\Models\Media;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->paginate(10);
        return view('backend.pages.services.index', compact('services'));
    }

    public function create()
    {
        $features = Feature::where('status', 'active')->get();
        return view('backend.pages.services.create', compact('features'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:services,title',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        
        // Upload main image (meta_image in your form)
        if ($request->hasFile('meta_image')) {
            $data['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Create service
        $service = Service::create($data);

        // Create SEO record
        $service->seo()->create($data);

        // Attach features
        if ($request->filled('features')) {
            $service->features()->sync($request->features);
        }

        // Handle Media uploads (Images)
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $service->id)
                ->where('model_type', Service::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');

                Media::create([
                    'model_type' => Service::class,
                    'model_id'   => $service->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $service->title,
                    'size'       => $size,
                    'is_main'    => !$hasDefault && $key === 0,
                    'created_by' => auth()->id(),
                ]);
                $hasDefault = true;
            }
        }

        // Handle Attachments (Documents)
        if ($request->hasFile('attachment_files')) {
            foreach ($request->file('attachment_files') as $index => $file) {
                $name = $request->attachment_names[$index] ?? $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads/attachments');
                
                Media::create([
                    'model_type' => Service::class,
                    'model_id'   => $service->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'document',
                    'alt_text'   => $name,
                    'size'       => $size,
                    'is_main'    => false,
                    'created_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = Service::with(['features', 'attachments', 'media'])->findOrFail($id);
        $features = Feature::where('status', 'active')->get();
        return view('backend.pages.services.edit', compact('service', 'features'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:services,title,' . $id,
            'description' => 'nullable|string'
        ]);

        $data = $request->all();

        // Handle OG image
        $ogImagePath = $service->seo->og_image ?? null;
        if ($request->hasFile('meta_image')) {
            // Delete old OG image if exists
            if ($ogImagePath && file_exists(public_path($ogImagePath))) {
                unlink(public_path($ogImagePath));
            }
            $data['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Update service
        $service->update($data);

        // Prepare SEO data - only include relevant fields
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $data['og_image'] ?? $ogImagePath,
        ];

        // Update or create SEO record
        if ($service->seo) {
            $service->seo()->update($seoData);
        } else {
            $service->seo()->create($seoData);
        }

        // Sync features
        if ($request->filled('features')) {
            $service->features()->sync($request->features);
        } else {
            $service->features()->detach();
        }

        // Handle main image selection
        if ($request->filled('is_main')) {
            // Reset all media to not default
            Media::where('model_id', $service->id)
                ->where('model_type', Service::class)
                ->where('type', 'image')
                ->update(['is_main' => false]);
                
            // Set the selected media as main
            if (str_starts_with($request->is_main, 'new_')) {
                // This is a new image, we'll handle it after upload
                $newMainFlag = true;
            } else {
                // This is an existing image
                Media::where('id', $request->is_main)
                    ->where('model_id', $service->id)
                    ->where('model_type', Service::class)
                    ->update(['is_main' => true]);
            }
        }

        // Handle Media deletion
        if ($request->filled('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->model_id == $service->id && $media->model_type == Service::class) {
                    ImageHelper::deleteImage($media->path);
                    $media->delete();
                }
            }
        }

        // Handle Media uploads (Gallery)
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $service->id)
                ->where('model_type', Service::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $isMain = (!$hasDefault && $key === 0) || (isset($newMainFlag) && $newMainFlag);
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');
                
                Media::create([
                    'model_type' => Service::class,
                    'model_id'   => $service->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $service->title,
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

        // Handle Attachments deletion
        if ($request->filled('delete_attachments')) {
            foreach ($request->delete_attachments as $attachmentId) {
                $media = Media::find($attachmentId);
                if ($media && $media->model_id == $service->id && $media->model_type == Service::class) {
                    ImageHelper::deleteImage($media->path);
                    $media->delete();
                }
            }
        }

        // Update existing attachment files and names
        foreach ($request->file('existing_attachment_files', []) as $id => $file) {
            if ($file?->isValid() && $media = Media::where('id', $id)->where('model_id', $service->id)->where('model_type', Service::class)->first()) {
                // Delete old file
                ImageHelper::deleteImage($media->path);

                // Prepare metadata before upload
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads/attachments');

                // Update media
                $media->update([
                    'path' => $path,
                    'name' => $name,
                    'size' => $size,
                    'created_by' => auth()->id(),
                ]);
            }
        }


        // Handle new Attachments
        if ($request->hasFile('new_attachment_files')) {
            foreach ($request->file('new_attachment_files') as $index => $file) {
                $name = $request->new_attachment_names[$index] ?? $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads/attachments');
                
                Media::create([
                    'model_type' => Service::class,
                    'model_id'   => $service->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'document',
                    'alt_text'   => $name,
                    'size'       => $size,
                    'is_main'    => false,
                    'created_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::with(['seo', 'media', 'attachments'])->findOrFail($id);

        // Delete SEO OG image
        if ($og = $service->seo?->og_image) {
            ImageHelper::deleteImage($og);
            $service->seo()->delete();
        }

        // Delete media files
        foreach ($service->media as $media) {
            ImageHelper::deleteImage($media->path);
            $media->delete();
        }

        // Delete attachment files
        foreach ($service->attachments as $attachment) {
            ImageHelper::deleteImage($attachment->path);
            $attachment->delete();
        }

        // Detach related features (pivot table)
        $service->features()->detach();

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

    public function toggleMenu(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->is_menu = !$service->is_menu;
        $service->save();

        return response()->json([
            'success' => true,
            'message' => 'Menu visibility updated successfully',
            'status' => $service->is_menu
        ]);
    }
}