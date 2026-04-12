<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Site;

class MonitorSites extends Command
{
    protected $signature = 'app:monitor-sites';
    protected $description = 'Monitor all sites to check if they are up or down.';

    public function handle()
    {
        $sites = Site::all();
        $this->info("Checking {$sites->count()} sites...");

        foreach ($sites as $site) {
            $startTime = microtime(true);
            $isUpNow = false;

            try {
                // Use a reasonable timeout so one slow site doesn't kill the whole command
                $response = Http::timeout(10)->get($site->url);
                $isUpNow = $response->successful();
            } catch (\Exception $e) {
                $isUpNow = false;
            }

            $endTime = microtime(true);
            $responseTimeMs = round(($endTime - $startTime) * 1000);

            // Logic Fix: Capture the OLD status before updating
            $wasUp = $site->is_up;

            // Update site model data
            $site->response_time_ms = $responseTimeMs;
            $site->last_checked_at = now();
            $site->is_up = $isUpNow;

            // --- Status Change Logic ---
            
            if (!$isUpNow && $wasUp) {
                // Site JUST went down
                $site->last_down_at = now();
                $this->sendAlertEmail($site, 'down');
                // $site->is_down_notified = true;
                $this->warn("Site {$site->name} is DOWN. Alert sent.");
            } 
            elseif ($isUpNow && !$wasUp) {
                // Site JUST came back up

                // Calculate downtime
                $downtimeText = null;
                if ($site->last_down_at) {
                    $downtimeText = $site->last_down_at->diffForHumans(now(), [
                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                        'parts' => 2,
                    ]);
                }

                $this->sendAlertEmail($site, 'up', $downtimeText);
                // $site->is_down_notified = false;
                $site->last_down_at = null; // Reset downtime tracker
                $this->info("Site {$site->name} is UP again. Alert sent.");
            } 
            else {
                // No change in status
                $statusText = $isUpNow ? 'UP' : 'DOWN';
                $this->line("Site {$site->name} is $statusText. ({$responseTimeMs}ms)");
            }

            $site->save();
        }

        $this->info('Site monitoring completed.');
    }

    private function sendAlertEmail(Site $site, string $status, ?string $downtimeText = null)
    {
        $email = $site->alert_email ?: optional($site->user)->email;

        if (!$email) return;

        try {
            $isDown = $status === 'down';
            $subject = $isDown ? "🚨 [ALERT] Site DOWN: {$site->name}" : "✅ [RESOLVED] Site UP: {$site->name}";
            $color = $isDown ? '#ef4444' : '#10b981';
            $bgColor = $isDown ? '#fef2f2' : '#ecfdf5';
            $borderColor = $isDown ? '#f87171' : '#34d399';
            $icon = $isDown ? '🚨' : '✅';
            $statusText = $isDown ? 'OFFLINE' : 'ONLINE';
            $appName = config('app.name') ?: 'Site Monitor';
            $time = now()->format('d F Y - h:i A');

            $htmlBody = "
                <div style=\"background-color: #f3f4f6; padding: 40px 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;\">
                    <div style=\"max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 1px solid #e5e7eb;\">
                        
                        <!-- Header -->
                        <div style=\"background-color: {$color}; padding: 40px 20px; text-align: center;\">
                            <div style=\"font-size: 56px; margin-bottom: 16px; line-height: 1;\">{$icon}</div>
                            <h1 style=\"margin: 0; font-size: 26px; color: #ffffff; font-weight: 700; letter-spacing: -0.5px;\">
                                " . ($isDown ? 'Uptime Alert: Site Offline' : 'Uptime Alert: Site Online') . "
                            </h1>
                        </div>

                        <!-- Body -->
                        <div style=\"padding: 40px 30px; color: #374151; line-height: 1.6;\">
                            <p style=\"font-size: 16px; margin-top: 0; margin-bottom: 24px;\">Hello,</p>
                            <p style=\"font-size: 16px; margin-bottom: 24px;\">
                                Your monitored website <strong>{$site->name}</strong> is currently 
                                <span style=\"display: inline-block; padding: 4px 12px; background-color: {$bgColor}; color: {$color}; border-radius: 9999px; font-weight: 600; font-size: 14px; border: 1px solid {$borderColor}; margin-left: 4px;\">
                                    {$statusText}
                                </span>
                            </p>

                            <!-- Metric Card -->
                            <div style=\"background: #f9fafb; border: 1px solid #f3f4f6; border-radius: 8px; padding: 24px; margin-bottom: 32px;\">
                                <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size: 15px;\">
                                    <tr>
                                        <td style=\"padding-bottom: 12px; color: #6b7280;\"><strong>Target URL</strong></td>
                                        <td style=\"padding-bottom: 12px; text-align: right;\"><a href=\"{$site->url}\" style=\"color: #3b82f6; text-decoration: none; font-weight: 500;\">{$site->url}</a></td>
                                    </tr>
                                    " . (!$isDown ? "<tr>
                                        <td style=\"padding-bottom: 12px; color: #6b7280;\"><strong>Response Time</strong></td>
                                        <td style=\"padding-bottom: 12px; text-align: right; color: #111827; font-weight: 500;\">{$site->response_time_ms} ms</td>
                                    </tr>" : "") . "
                                    " . (!$isDown && $downtimeText ? "<tr>
                                        <td style=\"padding-bottom: 12px; color: #6b7280;\"><strong>Downtime</strong></td>
                                        <td style=\"padding-bottom: 12px; text-align: right; color: #111827; font-weight: 500;\">{$downtimeText}</td>
                                    </tr>" : "") . "
                                    <tr>
                                        <td style=\"color: #6b7280;\"><strong>Time Checked</strong></td>
                                        <td style=\"text-align: right; color: #111827; font-weight: 500;\">{$time}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Action Button -->
                            <div style=\"text-align: center; margin-top: 10px;\">
                                <a href=\"{$site->url}\" style=\"display: inline-block; background-color: {$color}; color: #ffffff; padding: 14px 32px; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);\">
                                    " . ($isDown ? 'Check Server Now' : 'Visit Website') . "
                                </a>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div style=\"background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 24px; text-align: center;\">
                            <p style=\"margin: 0; font-size: 13px; color: #6b7280;\">
                                Sent securely by <strong>{$appName}</strong> Monitoring System
                            </p>
                        </div>
                    </div>
                </div>
            ";

            // Using html() is fine, but consider Mail::send() with a view if this grows.
            Mail::html($htmlBody, function ($message) use ($email, $subject) {
                $message->to($email)->subject($subject);
            });

        } catch (\Exception $e) {
            Log::error("Failed to send site status email to {$email}: " . $e->getMessage());
        }
    }
}