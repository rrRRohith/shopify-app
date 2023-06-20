<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Shop{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        if(shop())
            return $next($request);
        else
            return redirect()->route('shops.index')->with('error', 'Please login into a shop inorder to access these pages');
    }
}
