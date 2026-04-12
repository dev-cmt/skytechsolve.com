<?php

namespace App\Http\Controllers;

use App\Models\VisitorRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitorRecord::query();

        // Filter by Visit Type (page, asset, bot)
        $visit_type = $request->visit_type ?? 'page';
        if ($visit_type !== 'all') {
            $query->where('visit_type', $visit_type);
        }

        // Filter by Unique Visitors (Type)
        if ($request->type === 'unique') {
            // Get the latest record for each unique IP
            $query->whereIn('id', function($q) use ($visit_type) {
                $subQuery = $q->select(DB::raw('MAX(id)'))
                              ->from('visitor_records');
                if ($visit_type !== 'all') {
                    $subQuery->where('visit_type', $visit_type);
                }
                $subQuery->groupBy('ip_address');
            });
        }

        // Search functionality
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('browser', 'like', "%{$search}%")
                  ->orWhere('page_url', 'like', "%{$search}%");
            });
        }

        // Fetch Main Log (Paginated)
        $visitors = $query->latest()->paginate(20)->withQueryString();

        // Helper for Stats
        $statsQuery = VisitorRecord::query();
        if ($visit_type !== 'all') {
            $statsQuery->where('visit_type', $visit_type);
        }

        // Calculate Overview Stats
        $stats = [
            'total_visits' => (clone $statsQuery)->count(),
            'unique_visitors' => (clone $statsQuery)->distinct('ip_address')->count(),
            'visits_today' => (clone $statsQuery)->whereDate('created_at', today())->count(),
            'unique_today' => (clone $statsQuery)->whereDate('created_at', today())->distinct('ip_address')->count(),
            'avg_duration' => $this->calculateAvgDuration($visit_type),
        ];

        // Chart: Daily Visitors (Last 30 Days)
        $daily_stats = (clone $statsQuery)->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Rankings
        $top_countries = (clone $statsQuery)->select('country', DB::raw('count(*) as count'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $top_pages = (clone $statsQuery)->select('page_url', DB::raw('count(*) as count'))
            ->groupBy('page_url')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $top_referrers = (clone $statsQuery)->select('referrer_url', DB::raw('count(*) as count'))
            ->whereNotNull('referrer_url')
            ->groupBy('referrer_url')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Technographics (Pie Charts)
        $browsers = (clone $statsQuery)->select('browser', DB::raw('count(*) as count'))
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderByDesc('count')
            ->get();

        $os = (clone $statsQuery)->select('platform', DB::raw('count(*) as count'))
            ->whereNotNull('platform')
            ->groupBy('platform')
            ->orderByDesc('count')
            ->get();

        $devices = (clone $statsQuery)->select('device_type', DB::raw('count(*) as count'))
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        return view('backend.visitors.index', compact(
            'visitors', 
            'stats', 
            'daily_stats', 
            'top_countries', 
            'top_pages', 
            'top_referrers',
            'browsers',
            'os',
            'devices',
            'visit_type'
        ));
    }

    private function calculateAvgDuration($visit_type)
    {
        $query = DB::table('visitor_records');
        if ($visit_type !== 'all') {
            $query->where('visit_type', $visit_type);
        }

        $sessions = $query->select('session_id', DB::raw('TIMESTAMPDIFF(SECOND, MIN(created_at), MAX(created_at)) as duration'))
            ->whereNotNull('session_id')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('session_id')
            ->having('duration', '>', 0)
            ->get();

        if ($sessions->isEmpty()) return '0:00';

        $avgSeconds = $sessions->avg('duration');
        $minutes = floor($avgSeconds / 60);
        $seconds = round($avgSeconds % 60);

        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
