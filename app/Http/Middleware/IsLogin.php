<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class IsLogin
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

        if(Session::has('user')){
            // return $next($request);
            $id=Session::get("user")["id"];
            $url=$request->url();
            $url=explode('/',$url);
            // foreach($url as $u){
            //     $url=array_merge(explode('-',$u),$url);
            // }

            // $permission=permissions(Auth::user()->id);
            $permission=DB::table('permissions')->where('user_id',$id)->first();
            $view=json_decode($permission->view);
            $view=array_map('strtolower',$view);
            // dd($view);
            foreach($url as $item){
                if(in_array($item,$view))
                {
                    return $next($request);
                }
            }
            return redirect()->back();
        }else{
            return redirect()->route('login');
        }
        
    }
}
