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
            $add=json_decode($permission->add);
            $add=array_map('strtolower',$add);
            $edit=json_decode($permission->edit);
            $edit=array_map('strtolower',$edit);
            // dd($view);

            if(in_array('add',$url)){
                foreach($url as $item){
                    if(in_array($item,$add))
                    {
                        return $next($request);
                    }
                }
            }
            else if(in_array('edit',$url)){
                foreach($url as $item){
                    if(in_array($item,$edit))
                    {
                        return $next($request);
                    }
                }
            }
            else{
                foreach($url as $item){
                    if(in_array($item,$view))
                    {
                        return $next($request);
                    }
                }
            }


            // foreach($url as $item){
            //     if(in_array($item,$view))
            //     {
            //         if(in_array('add',$url)){
            //             foreach($url as $item){
            //                 if(in_array($item,$add))
            //                 {
            //                     return $next($request);
            //                 }
            //             }
            //         }
            //         else if(in_array('edit',$url)){
            //             foreach($url as $item){
            //                 if(in_array($item,$edit))
            //                 {
            //                     return $next($request);
            //                 }
            //             }
            //         }
            //         else{
            //             return $next($request);
            //         }
            //     }
            // }
            
            return redirect()->back();
            //  return $next($request);

        }else{
            return redirect()->route('login');
        }
        
    }
}
