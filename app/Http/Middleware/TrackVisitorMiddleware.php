<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitorRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TrackVisitorMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for non-GET requests or AJAX
        if (!$request->isMethod('GET') || $request->ajax()) {
            return $next($request);
        }

        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        
        // Basic User Agent Parsing
        $device = $this->getDevice($userAgent);
        $browser = $this->getBrowser($userAgent);
        $platform = $this->getPlatform($userAgent);
        $visitType = $this->getVisitType($request, $userAgent);

        // Geo Location (Cached to avoid hitting API limits)
        $geo = $this->getGeoLocation($ip);

        VisitorRecord::create([
            'ip_address'   => $ip,
            'user_agent'   => $userAgent,
            'device_type'  => $device,
            'browser'      => $browser,
            'platform'     => $platform,
            'page_url'     => $request->fullUrl(),
            'visit_type'   => $visitType,
            'referrer_url' => $request->header('referer'),
            'country'      => $geo['country'] ?? 'Unknown',
            'city'         => $geo['city'] ?? 'Unknown',
            'latitude'     => $geo['lat'] ?? null,
            'longitude'    => $geo['lon'] ?? null,
            'session_id'   => session()->getId(),
            'user_id'      => Auth::id(),
        ]);

        return $next($request);
    }

    private function getVisitType($request, $ua)
    {
        $bots = ['bot', 'crawl', 'spider', 'slurp', 'yahoo', 'mediapartners', 'seo', 'lighthouse', 'gtmetrix', 'pingdom'];
        if ($ua) {
            foreach ($bots as $bot) {
                if (stripos($ua, $bot) !== false) {
                    return 'bot';
                }
            }
        }
        
        $path = $request->path();
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $assets = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'mp4', 'webm', 'pdf', 'zip'];
        
        if (in_array($extension, $assets) || $request->is('storage/*') || $request->is('assets/*') || $request->is('frontend/images/*') || $request->is('backend/images/*') || $request->is('build/*')) {
            return 'asset';
        }
        
        return 'page';
    }

    private function getDevice($ua)
    {
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) return 'Tablet';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $ua)) return 'Mobile';
        return 'Desktop';
    }

    private function getBrowser($ua)
    {
        if (strpos($ua, 'MSIE') !== false || strpos($ua, 'Trident') !== false) return 'Internet Explorer';
        if (strpos($ua, 'Edge') !== false) return 'Edge';
        if (strpos($ua, 'Firefox') !== false) return 'Firefox';
        if (strpos($ua, 'Chrome') !== false) return 'Chrome';
        if (strpos($ua, 'Safari') !== false) return 'Safari';
        if (strpos($ua, 'Opera') !== false || strpos($ua, 'OPR') !== false) return 'Opera';
        return 'Unknown';
    }

    private function getPlatform($ua)
    {
        if (strpos($ua, 'Windows') !== false) return 'Windows';
        if (strpos($ua, 'Macintosh') !== false || strpos($ua, 'Mac OS') !== false) return 'Mac OS';
        if (strpos($ua, 'Linux') !== false) return 'Linux';
        if (strpos($ua, 'Android') !== false) return 'Android';
        if (strpos($ua, 'iPhone') !== false || strpos($ua, 'iPad') !== false) return 'iOS';
        return 'Unknown';
    }

    private function getGeoLocation($ip)
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return ['country' => 'Localhost', 'city' => 'Localhost'];
        }

        return Cache::remember('geo_ip_' . $ip, 86400, function () use ($ip) {
            try {
                $response = Http::timeout(3)->get("http://ip-api.com/json/{$ip}");
                if ($response->successful()) {
                    return $response->json();
                }
            } catch (\Exception $e) {
                // Fail silently
            }
            return null;
        });
    }
}
