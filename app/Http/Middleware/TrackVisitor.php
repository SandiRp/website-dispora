<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Standar ISO 27001 (Privasi Data): Kita hash (acak) IP Address 
        // agar tidak menyimpan data pribadi pengunjung secara mentah.
        $ip = hash('sha256', $request->ip());
        $date = now()->toDateString();

        // Menyimpan data pengunjung jika IP ini belum tercatat pada hari ini
        Visitor::firstOrCreate(
            [
                'ip_address' => $ip,
                'visit_date' => $date,
            ],
            [
                'user_agent' => $request->userAgent()
            ]
        );

        return $next($request);
    }
}
