<?php

namespace App\Http\Controllers\Quotes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller{ 
    
    public function showProducts(Request $request){
        if (Auth::check()) {
            $idUser = auth()->user()->id;
            $supplies = Product::with('project.images','user.roles','revisions','contacts')
                ->where('user_id',$idUser)
                ->whereHas('project', function (Builder $query) {
                    $query->where('status', '=', 'ACTIVO');
                })->get();
                /* ->whereHas('project')
                ->get(); */
            /* $supplies = $supplies->whereNotNull('project'); */
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
}