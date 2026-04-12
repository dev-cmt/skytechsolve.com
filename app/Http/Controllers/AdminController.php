<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\VisitorRecord;
use App\Models\Project;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Stats
        $data['total_applications'] = User::count();
        $data['total_visits'] = VisitorRecord::count();
        $data['unique_visitors'] = VisitorRecord::distinct('ip_address')->count();
        $data['visits_today'] = VisitorRecord::whereDate('created_at', today())->count();
        $data['unique_today'] = VisitorRecord::whereDate('created_at', today())->distinct('ip_address')->count();

        $data['total_projects'] = Project::count();
        $data['total_services'] = Service::count();
        $data['total_blogs'] = BlogPost::count();
        $data['total_contacts'] = \DB::table('contacts')->count();

        // Device breakdown
        $data['device_stats'] = VisitorRecord::select('device_type', \DB::raw('count(*) as total'))
            ->groupBy('device_type')
            ->pluck('total', 'device_type')
            ->toArray();

        // Recent Projects (as "Deals")
        $data['recent_projects'] = Project::with('category')->latest()->take(5)->get();

        // Recent Activity (Mixed)
        $blogs = BlogPost::latest()->take(5)->get()->map(fn($item) => [
            'type' => 'Blog Post',
            'title' => 'New blog: ' . $item->title,
            'time' => $item->created_at,
            'icon' => 'bi-newspaper',
            'color' => 'primary'
        ]);

        $projects = Project::latest()->take(5)->get()->map(fn($item) => [
            'type' => 'Project',
            'title' => 'New project: ' . $item->title,
            'time' => $item->created_at,
            'icon' => 'bi-briefcase',
            'color' => 'success'
        ]);

        $contacts = \DB::table('contacts')->latest()->take(5)->get()->map(fn($item) => [
            'type' => 'Inquiry',
            'title' => 'New contact from: ' . $item->name,
            'time' => \Carbon\Carbon::parse($item->created_at),
            'icon' => 'bi-envelope',
            'color' => 'warning'
        ]);

        $data['recent_activity'] = $blogs->concat($projects)->concat($contacts)->sortByDesc('time')->take(10);

        // Recent Visitors (Paginated)
        $data['recent_visitors'] = VisitorRecord::latest()->paginate(10, ['*'], 'visitors_page');

        // Chart Data: Last 7 Days (Sparklines)
        $data['sparkline_data'] = collect(range(6, 0))->map(function ($days) {
            return VisitorRecord::whereDate('created_at', today()->subDays($days))->count();
        })->toArray();

        // Chart Data: Monthly Analytics (Last 12 Months)
        $months = [];
        $visitor_counts = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = today()->subMonths($i);
            $months[] = $month->format('M');
            $visitor_counts[] = VisitorRecord::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }
        $data['monthly_labels'] = $months;
        $data['monthly_data'] = $visitor_counts;

        // Chart Data: Device Pie
        $data['device_pie_data'] = [
            $data['device_stats']['Mobile'] ?? 0,
            $data['device_stats']['Desktop'] ?? 0,
            $data['device_stats']['Tablet'] ?? 0,
            ($data['total_visits'] ?? 0) - array_sum($data['device_stats'])
        ];

        // Category stats (for Deals Status)
        $data['category_distribution'] = Category::withCount('projects')
            ->having('projects_count', '>', 0)
            ->get();

        return view('backend.dashboard', compact('data'));
    }

    public function resyncPermissions()
    {
        // -------------------------------
        // 1️⃣ Define Modules
        // -------------------------------
        $modules = [
            'sliders',
            'categories',
            'features',
            'tags',
            'services',
            'testimonials',
            'achievements',
            'projects',
            'teams',
            'clients',
            'blogs',
            'products',
            'sites',
            'users',
            'roles',
            'settings',
        ];

        $singlePermissions = [
            'view dashboard',
            'view story',
            'view missions',
            'view contact',
            'view submissions',
            'view seo',
            'view page content',
            'view developer api'
        ];

        $allPermissions = [];

        // -------------------------------
        // 2️⃣ Create / Update Module Permissions
        // -------------------------------
        foreach ($modules as $module) {
            foreach (['view', 'create', 'edit', 'delete'] as $action) {
                $permissionName = "{$action} {$module}";
                Permission::updateOrCreate(
                    ['name' => $permissionName],
                    ['guard_name' => 'web']
                );
                $allPermissions[] = $permissionName;
            }
        }

        // -------------------------------
        // 3️⃣ Create / Update Single Permissions
        // -------------------------------
        foreach ($singlePermissions as $perm) {
            Permission::updateOrCreate(
                ['name' => $perm],
                ['guard_name' => 'web']
            );
            $allPermissions[] = $perm;
        }

        // -------------------------------
        // 4️⃣ Remove old permissions safely
        // -------------------------------
        $permissionsToRemove = Permission::whereNotIn('name', $allPermissions)->get();

        foreach ($permissionsToRemove as $permission) {
            // Remove from all roles
            foreach ($permission->roles as $role) {
                $role->revokePermissionTo($permission);
            }
            // Delete the permission
            $permission->delete();
        }

        dd('Permissions fully synced successfully!');
    }

}
