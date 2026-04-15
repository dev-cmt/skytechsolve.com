<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PageSeoController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\DeveloperApiController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;


Route::get('/cc', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    dd('Application cache cleared!');
});
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sync-permissions', [AdminController::class, 'resyncPermissions'])->name('sync.permissions');

//___________________________________// START \\______________________________________________//
Route::get('/', [HomeController::class, 'welcome'])->name('home');

/**______________________________________________________________________________________________
 * View Page => ALL
 * ______________________________________________________________________________________________
 */
Route::get('comming/soon', [HomeController::class, 'comming_soon'])->name('comming_soon');
//______________ ABOUT US
Route::get('about-us', [HomeController::class, 'about'])->name('page.about-us');
//______________ SERVICES
Route::get('services-list', [HomeController::class, 'services'])->name('page.services');
Route::get('services-details/{slug}', [HomeController::class, 'servicesDetails'])->name('page.services-details');
//______________ PROJECTS
Route::get('projects-list', [HomeController::class, 'projects'])->name('page.projects');
Route::get('projects-details/{slug}', [HomeController::class, 'projectsDetails'])->name('page.projects-details');

Route::get('videos', [HomeController::class, 'projectsVideo'])->name('page.videos');
//______________ PRODUCTS
Route::get('products-list', [HomeController::class, 'products'])->name('page.products');
Route::get('products-details/{slug}', [HomeController::class, 'productsDetails'])->name('page.products-details');
Route::post('products-details/{slug}/purchase', [HomeController::class, 'productsPurchaseEnquiry'])->name('page.products.purchase');
//______________ BLOGS
Route::get('blogs-list', [HomeController::class, 'blogs'])->name('page.blogs');
Route::get('blogs-details/{slug}', [HomeController::class, 'blogsDetails'])->name('page.blogs-details');
Route::get('blogs/tag/{slug}', [HomeController::class, 'blogsTag'])->name('page.blogs-tag');
Route::get('blogs-author/{slug}', [HomeController::class, 'blogsDetails'])->name('page.blogs-author');

Route::post('blogs/{blog}/comments', [HomeController::class, 'blogsCommentsStore'])->name('page.blogs-comments.store');

Route::get('blogs/search', [HomeController::class, 'blogsSearch'])->name('page.blogs.search');
Route::get('blogs/ajax-search', [HomeController::class, 'blogsAjaxSearch'])->name('page.blogs.ajax');
Route::get('blogs/category/{slug}', [HomeController::class, 'blogsCategory'])->name('page.blogs.category');
//______________ TEAMS
Route::get('teams', [HomeController::class, 'teams'])->name('page.teams');
Route::get('teams-details/{slug}', [HomeController::class, 'teamsDetails'])->name('page.teams-details');
//______________ CONTACT
Route::get('contact-us', [HomeController::class, 'contact'])->name('page.contact-us');
Route::post('contact-us', [HomeController::class, 'contactStore'])->name('page.contact-us.store');

//______________ FRODLY FROM
Route::get('page/frodly', [HomeController::class, 'pageFrodly'])->name('page.frodly'); // Not used
Route::get('get/frodly', [HomeController::class, 'getFrodly'])->name('get.frodly');

// Admin dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/change-password', [ProfileController::class, 'editPassword'])->name('password.change');
    Route::put('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


Route::middleware('auth')->group(function () {
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Tags Routes
    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('tags/store', [TagController::class, 'store'])->name('tags.store');
    Route::post('tags/update', [TagController::class, 'update'])->name('tags.update');
    Route::delete('tags/{id}/delete', [TagController::class, 'destroy'])->name('tags.destroy');

    // Features
    Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
    Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
    Route::post('/features/update', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // Blog Routes
    Route::resource('blogs', BlogController::class);

    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::post('/testimonials/update', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Sliders
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
    Route::post('/sliders/update', [SliderController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');

    // Story
    Route::get('/story', [StoryController::class, 'index'])->name('story.index');
    Route::put('/story/{id}', [StoryController::class, 'update'])->name('story.update');

    // Services
    Route::post('services/toggle-menu/{id}', [ServiceController::class, 'toggleMenu'])->name('services.toggle_menu');
    Route::delete('services/image/{image}', [ServiceController::class, 'deleteImage'])->name('services.image.delete');
    Route::delete('services/attachment/{attachment}', [ServiceController::class, 'deleteAttachment'])->name('services.attachment.delete');
    Route::resource('services', ServiceController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::delete('projects/image/{image}', [ProjectController::class, 'deleteImage'])->name('projects.image.delete');

    // Achievements
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');
    Route::post('/achievements/update', [AchievementController::class, 'update'])->name('achievements.update');
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy'])->name('achievements.destroy');

    // Teams
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::post('/team/update', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::post('/clients/update', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/destroy/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Missions
    Route::get('/mission', [MissionController::class, 'index'])->name('mission.index');
    Route::post('/mission/update', [MissionController::class, 'update'])->name('mission.update');

    // contact
    Route::get('/contact', [ContactController::class, 'indexContact'])->name('contact.index');
    Route::get('/contact/{id}', [ContactController::class, 'showContact'])->name('contact.show');
    Route::post('/contact/{id}/create-sale', [ContactController::class, 'createSaleFromContact'])->name('contact.create-sale');
    Route::delete('/contact/{id}', [ContactController::class, 'destroyContact'])->name('contact.destroy');

    // sales
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
    Route::get('/sales/{id}/edit', [SalesController::class, 'edit'])->name('sales.edit');
    Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
    Route::post('/sales/{id}/update-status', [SalesController::class, 'updateStatus'])->name('sales.update-status');
    Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');

    Route::get('/submissions', [ContactController::class, 'indexSubmissions'])->name('submissions.index');
});

Route::middleware('auth')->group(function () {
    // Developer API
    Route::get('/developer-api', [DeveloperApiController::class, 'index'])->name('developer-api.index');
    Route::post('/developer-api/generate-token', [DeveloperApiController::class, 'generateToken'])->name('developer-api.generate-token');


    /**----------------------------------------------------------------------------------------------
     * ----------------------------------------------------------------------------------------------
     * BACKEND TEMPLATE
     * ----------------------------------------------------------------------------------------------
     * ----------------------------------------------------------------------------------------------
     */
    Route::resource('roles', RoleController::class);

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings-update', [SettingController::class, 'update'])->name('setting.update');

    // Site Monitoring
    Route::get('/sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('/visitors', [\App\Http\Controllers\VisitorController::class, 'index'])->name('visitors.index');
    Route::post('/sites/store', [SiteController::class, 'store'])->name('sites.store');
    Route::post('/sites/update', [SiteController::class, 'update'])->name('sites.update');
    Route::post('/sites/toggle-notified', [SiteController::class, 'toggleNotified'])->name('sites.toggle.notified');
    Route::delete('/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');

    // SEO settings
    Route::get('/seo-pages', [PageSeoController::class, 'index'])->name('settings.seo.index');
    Route::post('/seo-pages/{page}', [PageSeoController::class, 'update'])->name('settings.seo.update');

    // SEO settings
    Route::get('/pages-content', [PageContentController::class, 'index'])->name('settings.pages-content.index');
    Route::post('/pages-content/update', [PageContentController::class, 'update'])->name('settings.pages-content.update');
});

require __DIR__ . '/auth.php';
