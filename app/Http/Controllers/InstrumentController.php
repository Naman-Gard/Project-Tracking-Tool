<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function addInstrument(){
        return view('instrument.add');
    }

    public function editInstrument(){
        return view('instrument.edit');
    }
}
