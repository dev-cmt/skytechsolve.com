<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::with(['category', 'author'])->latest()->paginate(10);

        return view('backend.pages.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.pages.blog.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:published,scheduled,draft',
            'published_date' => 'nullable|date|required_if:status,scheduled|required_if:status,published'
        ]);

        // Generate slug from title
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        // Ensure slug is unique
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data = $request->all();

        $blogData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->input('content'),
            'author_id' => Auth::id(),
            'status' => $request->status,
            'published_date' => $request->published_date ?? now(),
        ];

        $blogPost = BlogPost::create($blogData);

        // Handle image upload using Media model
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = ImageHelper::uploadImage($file, 'uploads', null, 650, 500);

            Media::create([
                'model_type' => BlogPost::class,
                'model_id'   => $blogPost->id,
                'name'       => $name,
                'path'       => $path,
                'type'       => 'image',
                'alt_text'   => $blogPost->title,
                'size'       => $size,
                'is_main'    => true,
                'created_by' => auth()->id(),
            ]);
        }

        // Prepare SEO data
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        // Upload main image (meta_image in your form)
        if ($request->hasFile('meta_image')) {
            $seoData['og_image'] = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Create SEO record
        $blogPost->seo()->create($seoData);


        // ✅ Attach tags (short and clean)
        if ($request->filled('tags')) {
            $blogPost->tags()->sync($request->tags);
        }

        $notification = [
            'messege' => 'Blog post created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('blogs.index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.pages.blog.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:width=650,height=500',
            'status' => 'required|in:published,scheduled,draft',
            'published_date' => 'nullable|date|required_if:status,scheduled|required_if:status,published'
        ], [
            'image.dimensions' => 'Featured image size must be exactly 650x500 pixels.',
        ]);

        $updateData = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->input('content'),
            'status' => $request->status,
            'published_date' => $request->published_date,
        ];

        // Handle image upload using Media system
        if ($request->hasFile('image')) {
            // Delete old featured image if exists
            $oldMedia = $blog->media()->where('is_main', true)->first();
            if ($oldMedia) {
                ImageHelper::deleteImage($oldMedia->path);
                $oldMedia->delete();
            }

            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $path = ImageHelper::uploadImage($file, 'uploads', null, 650, 500);

            Media::create([
                'model_type' => BlogPost::class,
                'model_id'   => $blog->id,
                'name'       => $name,
                'path'       => $path,
                'type'       => 'image',
                'alt_text'   => $blog->title,
                'size'       => $size,
                'is_main'    => true,
                'created_by' => auth()->id(),
            ]);
        }

        // Handle image removal if checkbox is checked
        if ($request->has('remove_image')) {
            $featuredMedia = $blog->media()->where('is_main', true)->first();
            if ($featuredMedia) {
                ImageHelper::deleteImage($featuredMedia->path);
                $featuredMedia->delete();
            }
        }

        // Update slug if title changed
        if ($blog->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;

            while (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $updateData['slug'] = $slug;
        }

        // Handle OG image
        $ogImagePath = $blog->seo->og_image ?? null;
        $newOgImage = null;

        if ($request->hasFile('meta_image')) {
            // Delete old OG image if exists
            if ($ogImagePath && file_exists(public_path($ogImagePath))) {
                unlink(public_path($ogImagePath));
            }
            $newOgImage = ImageHelper::uploadImage($request->file('meta_image'), 'uploads/seo');
        }

        // Update blog
        $blog->update($updateData);

        // Prepare SEO data - only include relevant fields
        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'og_image' => $newOgImage ?? $ogImagePath,
        ];

        // Update or create SEO record
        if ($blog->seo) {
            $blog->seo()->update($seoData);
        } else {
            $blog->seo()->create($seoData);
        }


        $blog->tags()->sync($request->input('tags', []));

        return redirect()->route('blogs.index')->with(['messege' => 'Blog post updated successfully!', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog)
    {
        // Delete associated Media
        foreach ($blog->media as $media) {
            ImageHelper::deleteImage($media->path);
            $media->delete();
        }

        // Detach tags before delete
        $blog->tags()->detach();

        $blog->delete();

        return redirect()->route('blogs.index')->with(['messege' => 'Blog post deleted successfully!', 'alert-type' => 'success']);
    }
}
