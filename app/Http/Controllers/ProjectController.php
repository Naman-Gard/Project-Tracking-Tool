<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectDoc;

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

    public function addDoc(Request $request){
        $project_id=base64_decode($request->project_id);
        $doc=new ProjectDoc;

        $image=$request->file('file');

        $name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('assets/uploads/project-docs'),$name);

        $doc->project_id=$project_id;
        $doc->title=$request->title;
        $doc->name=$name;
        $doc->save();
        return redirect()->route('docs-by-project',$request->project_id)->with('success','Document Added Successfully');
    }
}
