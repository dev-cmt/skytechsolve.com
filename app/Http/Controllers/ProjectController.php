<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use App\Models\Category;
use App\Models\Media;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        return view('backend.pages.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('backend.pages.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title'          => 'required|string|max:255|unique:projects,title',
            'description'    => 'nullable|string',
            'client_name'    => 'nullable|string|max:255',
            'location'       => 'nullable|string|max:255',
            'tech_stack'     => 'nullable|string|max:255',
            'launch_year'    => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'project_budget' => 'nullable|numeric|min:0',
            'live_link'      => 'nullable|url|max:500',
        ]);

        $data = $request->all();

        // Upload main image (meta_image in your form)
        if ($request->hasFile('meta_image')) {
            $data['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Create Project
        $project = Project::create($data);

        // Create SEO record
        $project->seo()->create($data);

        // Handle Media uploads
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $project->id)
                ->where('model_type', Project::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');

                Media::create([
                    'model_type' => Project::class,
                    'model_id'   => $project->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $project->title,
                    'size'       => $size,
                    'is_main'    => !$hasDefault && $key === 0,
                    'created_by' => auth()->id(),
                ]);
                $hasDefault = true; // Set to true after first upload
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::with(['category', 'media'])->findOrFail($id);
        $categories = Category::where('status', true)->get();
        return view('backend.pages.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        // Validate the request data
        $validated = $request->validate([
            'title'          => 'required|string|max:255|unique:projects,title,' . $id,
            'description'    => 'nullable|string',
            'client_name'    => 'nullable|string|max:255',
            'location'       => 'nullable|string|max:255',
            'tech_stack'     => 'nullable|string|max:255',
            'launch_year'    => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
            'project_budget' => 'nullable|numeric|min:0',
            'live_link'      => 'nullable|url|max:500',
        ]);

        $data = $request->all();

        // Handle OG image
        $ogImagePath = $project->seo->og_image ?? null;
        if ($request->hasFile('meta_image')) {
            // Delete old OG image if exists
            if ($ogImagePath && file_exists(public_path($ogImagePath))) {
                unlink(public_path($ogImagePath));
            }
            $data['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Update project
        $project->update($data);

        // Prepare SEO data - only include relevant fields
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $data['og_image'] ?? $ogImagePath,
        ];

        // Update or create SEO record
        if ($project->seo) {
            $project->seo()->update($seoData);
        } else {
            $project->seo()->create($seoData);
        }

        // Handle main image selection
        if ($request->filled('is_main')) {
            // Reset all media to not default
            Media::where('model_id', $project->id)
                ->where('model_type', Project::class)
                ->update(['is_main' => false]);
 
            // Set the selected media as main
            if (str_starts_with($request->is_main, 'new_')) {
                // This is a new image, we'll handle it after upload
                $newMainFlag = true;
            } else {
                // This is an existing image
                Media::where('id', $request->is_main)
                    ->where('model_id', $project->id)
                    ->where('model_type', Project::class)
                    ->update(['is_main' => true]);
            }
        }

        // Handle Media deletion
        if ($request->filled('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->model_id == $project->id && $media->model_type == Project::class) {
                    ImageHelper::deleteImage($media->path);
                    $media->delete();
                }
            }
        }

        // Handle Media uploads
        if ($request->hasFile('media')) {
            $hasDefault = Media::where('model_id', $project->id)
                ->where('model_type', Project::class)
                ->where('is_main', true)
                ->exists();

            foreach ($request->file('media') as $key => $file) {
                $isMain = (!$hasDefault && $key === 0) || (isset($newMainFlag) && $newMainFlag);
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = ImageHelper::uploadImage($file, 'uploads');
 
                Media::create([
                    'model_type' => Project::class,
                    'model_id'   => $project->id,
                    'name'       => $name,
                    'path'       => $path,
                    'type'       => 'image',
                    'alt_text'   => $project->title,
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
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::with(['media'])->findOrFail($id);

        // Delete SEO OG image
        if ($og = $project->seo?->og_image) {
            ImageHelper::deleteImage($og);
            $project->seo()->delete();
        }

        // Delete media files
        foreach ($project->media as $media) {
            ImageHelper::deleteImage($media->path);
            $media->delete();
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleteImage($id)
    {
        $media = Media::findOrFail($id);

        // Delete physical file
        if ($media->path) {
            ImageHelper::deleteImage($media->path);
        }

        $media->delete();

        return response()->json(['success' => true]);
    }

}
