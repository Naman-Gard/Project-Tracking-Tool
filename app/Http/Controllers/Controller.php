<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index(){
        return view('auth.login');
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login');
    }

    public function register(){
        return view('auth.register');
    }

    public function setSession(Request $request){
        Session::put('user', $request->input('user')[0] ); 
    }

}
