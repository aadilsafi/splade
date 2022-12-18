<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LastActiveAtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

    // dd($request->url() == route('get-chats'));
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // dd();
        
        if($request->user()){
            $request->user()->update([
                'last_active_at' => now(),
                // 'last_active_url' => request()->route()->getName()
            ]);
        }
    }

}
