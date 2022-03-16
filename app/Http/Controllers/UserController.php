<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function permission()
    {
        return view('users.permission');
    }

    public function addUser(){
        return view('users.add');
    }
}
