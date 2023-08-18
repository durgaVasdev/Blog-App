<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // $user = auth()->check();
        $user->load('roles');
        $roles = $user->roles->pluck('name')->toArray();
        //($roles);
        if(array_search('admin', $roles) !== FALSE){
            return $next($request);
        } else if(array_search('user', $roles) !== FALSE){
            return redirect('home')->with('error',"You don't have admin access.");
        } else if(array_search('user', $roles) !== FALSE){
            return redirect('home')->with('error',"You don't have admin access.");
        }
   
        return redirect('home')->with('error',"You don't have admin access.");

    }
}
