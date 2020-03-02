<?php

namespace App\Http\Controllers\Quotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{ 

    public function showProducts(Request $request){
        if (Auth::check()) {
            $idUser = auth()->user()->id;
            $supplies = Product::with(
                'project.images','user.roles','revisions','contacts')
                ->where('user_id',$idUser)
                ->get(); /* ->toJson() */
            $supplies = $supplies->whereNotNull('project');
            foreach($supplies as $supply){
                if(strlen($supply->descripction) >55){
                    $supply->descripction = substr($supply->descripction, 0, 55)."...";
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
}