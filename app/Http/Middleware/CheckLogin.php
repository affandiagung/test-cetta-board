<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $response = Http::withHeaders(['Authorization' =>  'Bearer ' . (Session::get('api_token')),])->get(config('app.be_url') . 'auth/me');

        if (!$response->successful()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
