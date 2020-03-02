<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Projects\Project;
use Illuminate\Support\Facades\ File;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view('admin.projectsList')->with('projects', $projects);
    }
    
}
