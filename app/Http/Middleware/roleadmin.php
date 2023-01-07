<?php

namespace App\Http\Middleware;

use App\Helpers\HttpClient;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class roleadmin
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
        if(Session::has("token")) {
            $auth = HttpClient::fetch(
                "GET",
                "https://api-supplychainmeuble.fly.dev/api/me"
            );
            if(!$auth) {
                return redirect("/");
            }
            // dd($auth);
            if($auth['data']['id_role'] != 1) {
                return redirect(route('home'));
            }
        } else {
            return redirect("/");
        }
        return $next($request);
    }
    
}
