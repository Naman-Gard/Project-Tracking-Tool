<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function table()
    {
        return view('tables');
    }
    
    public function users()
    {
        return view('users.index');
    }
    
    public function profile(){
        return view('users.profile');
    }

    public function project(){
        return view('project.index');
    }

    public function instrument(){
        return view('instrument.index');
    }

    public function workOrder(){
        return view('work-order.index');
    }

    public function invoice(){
        return view('invoice.index');
    }
}
