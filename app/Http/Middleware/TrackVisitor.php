<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackVisitor
{
    private const COOKIE = 'yv_id';

    private const BOT_PATTERN = '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|whatsapp|telegram|curl|wget|python|httpclient|java\/|go-http|headless|lighthouse|pingdom|uptime|monitor|scrapy|axios|node-fetch/i';

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (! $this->shouldTrack($request, $response)) {
            return $response;
        }

        // Pengenal pengunjung dari cookie; dibuat otomatis jika belum ada.
        $visitorId = (string) $request->cookie(self::COOKIE);
        if (! preg_match('/^[A-Za-z0-9]{40}$/', $visitorId)) {
            $visitorId = Str::random(40);
            // Berlaku 24 jam agar terbaca sebagai "pengunjung harian".
            $response->headers->setCookie(cookie(self::COOKIE, $visitorId, 60 * 24, '/', null, $request->isSecure(), true, false, 'lax'));
        }

        try {
            // IP tetap di-hash (privasi), disimpan hanya sebagai data pendukung.
            Visitor::firstOrCreate(
                [
                    'visitor_id' => $visitorId,
                    'visit_date' => now()->toDateString(),
                ],
                [
                    'ip_address' => hash('sha256', (string) $request->ip()),
                    'user_agent' => $request->userAgent(),
                ]
            );
        } catch (Throwable $e) {
            // Statistik tidak boleh membuat halaman gagal dimuat (mis. race unique).
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || $request->ajax() || $request->expectsJson()) {
            return false;
        }

        if ($request->is('admin', 'admin/*', 'file/*', 'up', 'login', 'logout', 'storage/*')) {
            return false;
        }

        if ($response->getStatusCode() !== 200 || ! str_contains((string) $response->headers->get('Content-Type'), 'text/html')) {
            return false;
        }

        $userAgent = (string) $request->userAgent();

        return $userAgent !== '' && ! preg_match(self::BOT_PATTERN, $userAgent);
    }
}
