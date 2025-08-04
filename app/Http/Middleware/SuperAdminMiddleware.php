<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    if (!Auth::guard('super_admin')->check()) {
        // Debug forcé (sera visible même si logging échoue)
        error_log('SUPERADMIN MIDDLEWARE TRIGGERED - USER NOT AUTHENTICATED');
        
        return redirect()->route('super_admin.login')->withErrors([
            'auth' => 'Accès non autorisé'
        ]);
    }

    return $next($request);
}
}
