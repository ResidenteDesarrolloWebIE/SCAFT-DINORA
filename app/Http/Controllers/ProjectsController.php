<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Projects\Project;
use App\Models\UserDetails\Contact;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class ProjectsController extends Controller
{
    public function index(){
        $clients = User::whereHas('roles', function (Builder $query) {
            $query->where('name', '=', 'client');
        })->get();
        $contacts = Contact::all();
        $projects = Project::with('product.user','service.user')->get();
        return view('admin.projectsList')->with('projects', $projects)->with('clients', $clients)->with('contacts', $contacts);
    }

    public function changeStatus(Request $request){
        $project = Project::where('id',$request->id)->first();
        $project->status = $request->status;
        $project->save();
        return response()->json(["message"=>"Status actualizado correctamente"]);
    }
}
