<?php

namespace App\Http\Middleware;  
  
use Closure;  
use Illuminate\Http\Request;  
  
class RedirectIfNotAuthenticated  
{  
    public function handle(Request $request, Closure $next)  
    {  
        if (!auth()->check()) {  
            // Simpan URL yang ingin diakses  
            session(['url.intended' => $request->url()]);  
        }  
  
        return $next($request);  
    }  
}  
