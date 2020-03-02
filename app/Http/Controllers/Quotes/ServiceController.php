<?php

namespace App\Http\Controllers\Quotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes\Product;
use App\Models\Quotes\Service;
class ServiceController extends Controller
{
    public function showServices(Request $request){
        /* 
            Services where project!=null 
            Todos los servicios que tengan proyectos
        */
        $services = Service::with('project','user','contacts')->where('user_id', auth()->user()->id )->get(); /* ->toJson() */
        $services = $services->whereNotNull('project');
        foreach($services as $service){
            if(strlen($service->descripction) >55){
                $service->descripction = substr($service->descripction, 0, 55)."...";
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
