<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }
    
        // abort(403, 'Unauthorized');
        
    // Thay thế view_name bằng tên view tùy chỉnh của bạn
    return response()->view('backend.pages.errors.custom', ['message' => 'Unauthorized'], 403);

    // return view('backend.pages.errors.custom');
    }
}