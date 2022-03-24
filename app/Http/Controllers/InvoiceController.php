<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function addInvoice(){
        return view('invoice.add');
    }

    public function editInvoice(){
        return view('invoice.edit');
    }
}
