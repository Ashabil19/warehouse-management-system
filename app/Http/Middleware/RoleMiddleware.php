<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // app/Http/Middleware/RoleMiddleware.php
    public function handle($request, Closure $next, $role)  
    {  
        // Cek akses untuk halaman barangmasuk  
        if ($request->is('barangmasuk*')) {  
            // Jika user terautentikasi, boleh akses  
            if (auth()->check()) {  
                return $next($request);  
            }  
        }  
      
        // Cek akses untuk route lainnya  
        if (!auth()->check() || auth()->user()->role !== $role) {  
            abort(403, 'Unauthorized');  
        }  
      
        return $next($request);  
    }  
    

    
}
