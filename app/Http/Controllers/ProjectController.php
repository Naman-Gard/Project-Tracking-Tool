<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function addProject(){
        return view('project.add');
    }

    public function editProject(){
        return view('project.edit');
    }

    public function manageDocs(){
        return view('project-docs.index');
    }
}
