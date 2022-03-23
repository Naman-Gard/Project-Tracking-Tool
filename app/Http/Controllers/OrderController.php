<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addWorkOrder(){
        return view('work-order.add');
    }

    public function editWorkOrder(){
        return view('work-order.edit');
    }
}
