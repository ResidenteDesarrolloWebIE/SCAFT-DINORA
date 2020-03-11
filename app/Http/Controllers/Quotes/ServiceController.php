<?php

namespace App\Http\Controllers\Quotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes\Service;
use Illuminate\Database\Eloquent\Builder;

class ServiceController extends Controller
{
    public function showServices(Request $request){
        $services = Service::with('project','user','contacts')->where('user_id', auth()->user()->id )
        ->whereHas('project', function (Builder $query) {
            $query->where('status', '=', 'ACTIVO');
        })->get();
        /* ->whereHas('project')->get();  
        /* $services = $services->whereNotNull('project'); */
        foreach($services as $service){
            if(strlen($service->description) >55){
                $service->description = substr($service->description, 0, 55)."...";
            }
        }
        return view('client.services')->with('services', $services);
    }
    public function showMoreInformation(Request $request){
        $id = $request->id;
        $service = Service::with('project','user','orderedReviews.coin','contacts')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $service;
    }
    public function showFinancialAdvance(Request $request){
        $id = $request->id;
        $service = Service::with('project','user','progress','orderedReviews.coin','payments')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $service;
    }
    public function showTechnicalAdvance(Request $request){
        $id = $request->id;
        $service = Service::with('project','user','progress','orderedReviews.coin','payments')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $service;
    }
}
