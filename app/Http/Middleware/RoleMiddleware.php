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
    public function handle($request, Closure $next, $role)    
    {    
        // Cek apakah pengguna terautentikasi  
        if (!auth()->check()) {  
            abort(403, 'Unauthorized');  
        }  
  
        // Cek akses untuk halaman barangmasuk  
        if ($request->is('barangmasuk*')) {    
            return $next($request);    
        }  
  
        // Cek akses untuk halaman stock  
        if ($request->is('stock*') && auth()->user()->role === 'purchasing') {  
            return $next($request);  
        }  
  
        // Cek akses untuk route lainnya  
        $roles = explode(',', $role); // Mendapatkan array dari role yang diizinkan  
        if (!in_array(auth()->user()->role, $roles)) {    
            abort(403, 'Unauthorized');    
        }    
  
        return $next($request);    
    }    
}  
