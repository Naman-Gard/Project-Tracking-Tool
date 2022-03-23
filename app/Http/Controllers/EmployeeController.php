<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeDatasImport;
use App\Models\EmployeeDatas;

class EmployeeController extends Controller
{
    public function store(Request $request){
      //dd('abc');
      Excel::import(new EmployeeDatasImport, $request->file('file')->store('temp'));

      return redirect()->route('upload-employee')->with('Successfully-Uploaded','Excel File Successfully Uploaded');
    }
}
