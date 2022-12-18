<?php

namespace App\Http\Middleware;

use App\Utils\Common\StandardRoles;
use App\Utils\Helper;
use Closure;
use Illuminate\Http\Request;

class isTraineeMiddleware
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
        $user = auth()->user();
        if($user && $user->hasRole(StandardRoles::TraineeRole))
        {
            return $next($request);
        }
        return redirect()->back()->with('message' ,'Unauthorized');

    }
}
