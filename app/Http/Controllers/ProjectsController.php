<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Projects\Project;
use Illuminate\Support\Facades\ File;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Project::with('product.user','service.user')->get();
        return view('admin.projectsList')->with('projects', $projects);
    }

    public function changeStatus(Request $request){
        $project = Project::where('id',$request->id)->first();
        $project->status = $request->status;
        $project->save();
        return response()->json(["message"=>"Status actualizado correctamente"]);
    }
}
