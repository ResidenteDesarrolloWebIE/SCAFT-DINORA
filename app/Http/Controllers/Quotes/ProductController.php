<?php

namespace App\Http\Controllers\Quotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Quotes\SupplyRequest;

class ProductController extends Controller{ 
    
    public function showProducts(Request $request){
        if (Auth::check()) {
            $idUser = auth()->user()->id;
            $supplies = Product::with('project.images','user.roles','revisions','contacts')
                ->where('user_id',$idUser)
                ->whereHas('project', function (Builder $query) {
                    $query->where('status', '=', 'ACTIVO');
                })->get();
            foreach($supplies as $supply){
                if(strlen($supply->description) >55){
                    $supply->description = substr($supply->description, 0, 55)."...";
                }
            }
            return view('client.supplies')->with('supplies', $supplies);
        }
    }

    public function showMoreInformation(Request $request){
        $id = $request->id;
        $supply = Product::with('project','user','orderedReviews.coin','contacts')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $supply;
    }

    public function showFinancialAdvance(Request $request){
        $id = $request->id;
        $supply = Product::with('project','user','progress','orderedReviews.coin','payments')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $supply;
    }

    public function showTechnicalAdvance(Request $request){
        $id = $request->id;
        $supply = Product::with('project','user','progress','orderedReviews.coin','payments')
            ->where('user_id', auth()->user()->id )
            ->where('id', $id )->get();
        return $supply;
    }




    /* Nuevos metodos por nuevos requerimientos */

    public function create(SupplyRequest $request){
        dd($request->all());
        /* dd($request->all());
        $validator = Validator::make($request->all(), Product::$rules, Product::$messages);
        if ($validator->fails()) {
            return Response::json(['error' => true,'message' => $validator->getMessageBag()->toArray(),'code' => 400], 400);
        }  */ 
        return Response::json(['error' => true,'message' => "Correcto",'code' => 200], 200);
    }
}