<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Models\Sale;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Story;
use App\Models\Client;
use App\Models\Service;
use App\Models\Team;
use App\Models\Project;
use App\Models\Achievement;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Page;
use App\Http\Traits\SeoTrait;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\TrackVisitorMiddleware;

class HomeController extends Controller implements HasMiddleware
{
    use SeoTrait;
    public static function middleware(): array
    {
        return [
            new Middleware(TrackVisitorMiddleware::class, only: [
                'welcome',
                'about',
                'teams',
                'teamsDetails',
                'contact',
                'services',
                'servicesDetails',
                'projects',
                'projectsDetails',
                'products',
                'productsDetails',
                'blogs',
                'blogsDetails',
            ]),
        ];
    }

    public function welcome()
    {
        $story = Story::where('status', true)->first();
        $sliders = Slider::where('status', 'active')->orderBy('order', 'asc')->get();
        $testimonials = Testimonial::where('status', true)->latest()->get();
        $clients = Client::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $teams = Team::where('status', true)->orderBy('order')->get();
        $achievements = Achievement::where('status', 'active')->orderBy('sort_order')->get();
        $projects = Project::with('media')->latest()->take(8)->get();
        $blogPosts = BlogPost::with('author')->where('status', 'published')->where('published_date', '<=', now())->orderBy('published_date', 'desc')->take(3)->get();
        $products = Product::with('pricePlans')->active()->ordered()->take(3)->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'home')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
        ]);

        return view('frontend.welcome', compact('sliders', 'story', 'services', 'achievements', 'testimonials', 'teams', 'clients', 'projects', 'blogPosts', 'products', 'seotags', 'breadcrumbs', 'page'));
    }
    /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function about()
    {
        $story = Story::where('status', true)->first();
        $testimonials = Testimonial::where('status', true)->latest()->get();
        $clients = Client::active()->ordered()->get();
        $teams = Team::where('status', true)->orderBy('order')->get();
        $achievements = Achievement::where('status', 'active')->orderBy('sort_order')->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'about')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'About', 'url' => url()->current()],
        ]);

        return view('frontend.pages.about-us', compact('story', 'achievements', 'testimonials', 'teams', 'clients', 'seotags', 'breadcrumbs', 'page'));
    }
    /**________________________________________________________________________________________
     * Teams Menu Pages
     * ________________________________________________________________________________________
     */
    public function teams()
    {
        $teams = Team::active()->ordered()->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'teams')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Teams', 'url' => url()->current()],
        ]);

        return view('frontend.pages.teams', compact('seotags', 'breadcrumbs', 'teams', 'page'));
    }
    public function teamsDetails($slug)
    {
        $team = Team::with('seo')->where('slug', $slug)->firstOrFail();

        // SEO
        $this->setSeo([
            'title' => $team->seo->meta_title ?? $team->name,
            'description' => $team->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($team->seo->meta_keywords ?? ''),
            'image' => $team->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Teams', 'url' => url()->current()],
        ]);

        return view('frontend.pages.teams-details', compact('team', 'seotags', 'breadcrumbs'));
    }
    /**________________________________________________________________________________________
     * Contact Menu Pages
     * ________________________________________________________________________________________
     */
    public function contact()
    {
        $clients = Client::active()->ordered()->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'contact')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Contact', 'url' => url()->current()],
        ]);

        return view('frontend.pages.contact-us', compact('clients', 'seotags', 'breadcrumbs', 'page'));
    }
    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Contact::create([
            'type' => 'contact',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_seen' => false,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    /**________________________________________________________________________________________
     * Services Menu Pages
     * ________________________________________________________________________________________
     */
    public function services()
    {
        $services = Service::active()->ordered()->get();
        $achievements = Achievement::where('status', 'active')->orderBy('sort_order')->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'services')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Services', 'url' => url()->current()],
        ]);

        // Page Content
        $page = Page::where('slug', 'services')->firstOrFail();

        return view('frontend.pages.services', compact('services', 'achievements', 'seotags', 'breadcrumbs', 'page'));
    }
    public function servicesDetails($slug)
    {
        // Load service with all needed relations
        $service = Service::with(['media', 'attachments', 'features', 'seo'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Optional: Load all services for sidebar list
        $allServices = Service::active()->ordered()->get();

        // SEO
        $this->setSeo([
            'title' => $service->seo->meta_title ?? $service->title,
            'description' => $service->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($service->seo->meta_keywords ?? ''),
            'image' => $service->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();
        // $json_ld = $this->generateProductJsonLd($data);

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Service Details', 'url' => url()->current()],
        ]);

        return view('frontend.pages.services-details', compact('service', 'allServices', 'seotags', 'breadcrumbs'));
    }
    /**________________________________________________________________________________________
     * Project Menu Pages
     * ________________________________________________________________________________________
     */
    public function projects()
    {
        $projects = Project::with('category')->latest()->paginate(9);

        // SEO
        $page = Page::with('seo')->where('slug', 'projects')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Projects', 'url' => url()->current()],
        ]);

        return view('frontend.pages.projects', compact('projects', 'seotags', 'breadcrumbs', 'page'));
    }
    public function projectsDetails($slug)
    {
        $project = Project::with('category')->where('slug', $slug)->firstOrFail();

        // SEO
        $this->setSeo([
            'title' => $project->seo->meta_title ?? $project->title,
            'description' => $project->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($project->seo->meta_keywords ?? ''),
            'image' => $project->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();
        // $json_ld = $this->generateProductJsonLd($data);

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Project Details', 'url' => url()->current()],
        ]);

        return view('frontend.pages.projects-details', compact('project', 'seotags', 'breadcrumbs'));
    }
    /**________________________________________________________________________________________
     * Project Menu Pages
     * ________________________________________________________________________________________
     */
    public function projectsVideo()
    {
        // SEO
        $page = Page::with('seo')->where('slug', 'projects-video')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Projects', 'url' => url()->current()],
        ]);

        return view('frontend.pages.projects-video', compact('seotags', 'breadcrumbs', 'page'));
    }
    /**________________________________________________________________________________________
     * Blog Menu Pages
     * ________________________________________________________________________________________
     */
    public function blogs()
    {
        $blogPosts = BlogPost::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->where('published_date', '<=', now())
            ->orderBy('published_date', 'desc')
            ->paginate(8);

        $categories = Category::withCount('blogPosts')->get();
        $allTags = Tag::all();
        $recentPosts = BlogPost::latest()->take(5)->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'blogs')->firstOrFail();
        $this->setSeo([
            'title' => $page->seo->meta_title ?? $page->title,
            'description' => $page->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
            'image' => $page->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blogs', 'url' => url()->current()],
        ]);

        return view('frontend.pages.blogs', compact('blogPosts', 'categories', 'allTags', 'recentPosts', 'seotags', 'breadcrumbs'));
    }
    // Blog details page
    public function blogsDetails($slug)
    {
        $post = BlogPost::with(['author', 'category', 'tags', 'comments.replies'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('published_date', '<=', now())
            ->firstOrFail();

        $categories = Category::withCount('blogPosts')->get();
        $recentPosts = BlogPost::latest()->take(5)->get();
        $allTags = Tag::all();

        // SEO
        $this->setSeo([
            'title' => $post->seo->meta_title ?? $post->title,
            'description' => $post->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($post->seo->meta_keywords ?? ''),
            'image' => $post->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();
        // $json_ld = $this->generateProductJsonLd($data);

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blog Details', 'url' => url()->current()],
        ]);

        return view('frontend.pages.blogs-details', compact('post', 'categories', 'recentPosts', 'allTags', 'seotags', 'breadcrumbs'));
    }
    // Blogs by tag
    public function blogsTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $blogPosts = $tag->blogPosts()
            ->with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->where('published_date', '<=', now())
            ->orderBy('published_date', 'desc')
            ->paginate(8);

        $categories = Category::withCount('blogPosts')->get();
        $allTags = Tag::all();
        $recentPosts = BlogPost::latest()->take(5)->get();

        // SEO
        $this->setSeo([
            'title' => $tag->seo->meta_title ?? $tag->title,
            'description' => $tag->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($tag->seo->meta_keywords ?? ''),
            'image' => $tag->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();
        // $json_ld = $this->generateProductJsonLd($data);

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blog Details', 'url' => url()->current()],
        ]);

        return view('frontend.pages.blogs', compact('blogPosts', 'tag', 'categories', 'allTags', 'recentPosts', 'seotags', 'breadcrumbs'));
    }
    // Blogs by category
    public function blogsCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $blogPosts = BlogPost::where('category_id', $category->id)
            ->where('status', 'published')
            ->where('published_date', '<=', now())
            ->with(['author', 'tags'])
            ->orderBy('published_date', 'desc')
            ->paginate(8);

        $categories = Category::withCount('blogPosts')->get();
        $allTags = Tag::all();
        $recentPosts = BlogPost::latest()->take(5)->get();

        // SEO
        $this->setSeo([
            'title' => $category->seo->meta_title ?? $category->title,
            'description' => $category->seo->meta_description ?? '',
            'keywords' => $this->formatKeywords($category->seo->meta_keywords ?? ''),
            'image' => $category->seo->og_image ?? '',
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();
        // $json_ld = $this->generateProductJsonLd($data);

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Blog Details', 'url' => url()->current()],
        ]);

        return view('frontend.pages.blogs', compact('blogPosts', 'category', 'categories', 'allTags', 'recentPosts', 'seotags', 'breadcrumbs'));
    }
    // Blogs by search
    public function blogsSearch(Request $request)
    {
        $query = $request->input('query');

        $blogPosts = BlogPost::where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
        })
            ->where('status', 'published')
            ->where('published_date', '<=', now())
            ->with(['author', 'category', 'tags'])
            ->orderBy('published_date', 'desc')
            ->paginate(8);

        $categories = Category::withCount('blogPosts')->get();
        $allTags = Tag::all();
        $recentPosts = BlogPost::latest()->take(5)->get();

        return view('frontend.pages.blogs', compact('blogPosts', 'query', 'categories', 'allTags', 'recentPosts'));
    }
    // Store comment
    public function blogsCommentsStore(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        $blog->comments()->create([
            'parent_id' => $validated['parent_id'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment submitted successfully!');
    }
    /**
     * AJAX search for Services, Projects, and Blogs
     */
    public function blogsAjaxSearch(Request $request)
    {
        $query = $request->get('query');
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Services
        $services = Service::active()
            ->where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get();
        foreach ($services as $service) {
            $mainMedia = $service->media->where('is_main', 1)->first();
            $results[] = [
                'title' => $service->title,
                'link' => route('page.services-details', $service->slug),
                'image' => $mainMedia ? asset($mainMedia->path) : asset('frontend/images/resource/news-1.jpg'),
                'type' => 'Service'
            ];
        }

        // Projects
        $projects = Project::active()
            ->where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get(['title', 'slug']);
        foreach ($projects as $project) {
            $mainImg = $project->media->where('is_main', 1)->first();
            $results[] = [
                'title' => $project->title,
                'link' => route('page.projects-details', $project->slug),
                'image' => $mainImg ? asset($mainImg->path) : asset('frontend/images/resource/news-1.jpg'),
                'type' => 'Project'
            ];
        }

        // Blogs
        $blogs = BlogPost::where('status', 'published')
            ->where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get(['title', 'slug', 'image_path']);
        foreach ($blogs as $blog) {
            $results[] = [
                'title' => $blog->title,
                'link' => route('page.blogs-details', $blog->slug),
                'image' => $blog->main_image ? asset($blog->main_image->path) : asset('frontend/images/resource/news-1.jpg'),
                'type' => 'Blog'
            ];
        }

        // Products
        $products = Product::active()
            ->where('title', 'LIKE', "%{$query}%")
            ->take(5)
            ->get(['title', 'image']);
        foreach ($products as $product) {
            $mainImg = $product->media->where('is_main', 1)->first();
            $results[] = [
                'title' => $product->title,
                'link' => route('page.products'),
                'image' => $mainImg ? asset($mainImg->path) : asset('frontend/images/resource/news-1.jpg'),
                'type' => 'Product'
            ];
        }

        return response()->json($results);
    }
    /**________________________________________________________________________________________
     * Products Menu Pages
     * ________________________________________________________________________________________
     */
    public function products()
    {
        $products = Product::with(['pricePlans', 'media'])->active()->ordered()->get();

        // SEO
        $page = Page::with('seo')->where('slug', 'products')->first();

        // If products page doesn't exist in pages table, create a fallback or skip SEO
        if($page) {
            $this->setSeo([
                'title' => $page->seo->meta_title ?? $page->title,
                'description' => $page->seo->meta_description ?? '',
                'keywords' => $this->formatKeywords($page->seo->meta_keywords ?? ''),
                'image' => $page->seo->og_image ?? '',
                'canonical' => url()->current(),
            ]);
        }

        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Products', 'url' => url()->current()],
        ]);

        return view('frontend.pages.products', compact('products', 'seotags', 'breadcrumbs', 'page'));
    }

    public function productsDetails($slug)
    {
        $product = Product::with(['pricePlans' => function($q) {
            $q->active()->ordered();
        }, 'media'])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Related products (same type, excluding current)
        $relatedProducts = Product::with('media')
            ->active()
            ->where('id', '!=', $product->id)
            ->when($product->type, fn($q) => $q->where('type', $product->type))
            ->ordered()
            ->take(3)
            ->get();

        // SEO
        $this->setSeo([
            'title' => $product->seo->meta_title ?? $product->title,
            'description' => $product->seo->meta_description ?? $product->subtitle,
            'keywords' => $this->formatKeywords($product->seo->meta_keywords ?? ''),
            'image' => $product->seo->og_image ?? ($product->media->where('is_main', 1)->first()->path ?? ''),
            'canonical' => url()->current(),
        ]);
        $seotags = $this->generateTags();

        $breadcrumbs = $this->generateBreadcrumbJsonLd([
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Products', 'url' => route('page.products')],
            ['name' => $product->title, 'url' => url()->current()],
        ]);

        return view('frontend.pages.products-details', compact('product', 'relatedProducts', 'seotags', 'breadcrumbs'));
    }

    public function productsPurchaseEnquiry(Request $request, $slug)
    {
        $product = Product::active()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'plan_id' => 'nullable|integer',
            'note'    => 'nullable|string|max:2000',
            'source'  => 'nullable|string|max:100',
        ]);

        $selectedPlan = null;
        if (!empty($validated['plan_id'])) {
            $selectedPlan = $product->pricePlans()->whereKey($validated['plan_id'])->first();
        }

        $planName = $selectedPlan?->name ?? null;
        $planId = $selectedPlan?->id ?? null;
        $planPart = $planName ? ' — Plan: ' . $planName : '';

        Sale::create([
            'product_id' => $product->id,
            'plan_id' => $planId,
            'source' => $validated['source'] ?? 'product_page',
            'customer_ip' => $request->ip(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => 'Purchase Enquiry: ' . $product->title . $planPart,
            'message' => $validated['note'] ?? null,
            'status' => 'new',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you, ' . $validated['name'] . '! Your enquiry has been received. We\'ll contact you shortly.'
            ]);
        }

        return redirect()
            ->route('page.products-details', $slug)
            ->with('purchase_success', 'Thank you, ' . $validated['name'] . '! Your enquiry has been received. We\'ll contact you at ' . $validated['email'] . ' shortly.');
    }
}
