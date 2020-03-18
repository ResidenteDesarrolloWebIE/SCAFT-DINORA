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

    public function create(Request $request){
        dd(
            $request->clientQuoteProduct,
            $request->contactQuoteProduct,
            $request->dateQuoteProduct,
            $request->fileQuotesProduct,
            $request->descriptionQuoteProduct,
            $request->noteQuoteProduct,
            $request->biddingQuoteProduct,
        ); 
        try {
            
            $quotation = new product();
            $quotation->folio = $request->clientQuoteProduct;
            $quotation->description = $request->descriptionQuoteProduct;
            $quotation->total_amount = $request->totalAmountQuoteProduct;
            $quotation->status = $request->statusQuoteProduct;
            $quotation->notes = $request->noteQuoteProduct;
            $quotation->estimated_date = $request->estimatedDateQuoteProduct;
            $quotation->bidding = $request->biddingQuoteProduct;
            $quotation->user_id = $request->clientQuoteProduct;
            $quotation->contact_id = $request->contactQuoteProduct;
            $quotation->save();
        } catch (\Throwable $th) {
            dd($th);
            /* return Response::json(['error' => false,'message' => "Cotizacion creada correctamente",'code' => 200], 200); */
            abort(response()->json('Todo fue correcto', 200));
        }
        
        
    }
    /* 
        $mypq = new product_quotation();
        $mypq->folio = $this->nextfolio();
        $mypq->description = Input::get('quotation_description');
        $mypq->total_amount = 0.0;
        $mypq->status = "Registrada";
        $mypq->user_id =  Auth::user()->id;
        $mypq->approved_revision_id = 1;
        $mypq->customer_id = Input::get('quotation_customer');
        $mypq->contact_id = Input::get('slt_quotation_contact');
        $mypq->notes = Input::get('quotation_notes');
        $mypq->estimated_date = Input::get('quotation_estimateddate');
        if(Input::get('quotation_bidding') == "on"){
            $mypq->bidding = "1";
        } else {
            $mypq->bidding = "0";
        }
        
        $myrevq = new revision_quotation();        
        $myrevq->revision_date = now();
        $myrevq->notes = "";
        $myrevq->user_id = Auth::user()->id;
        $myrevq->revision_number = 1;

        //NUEVO
        $myProductQP = new quotation_progress();
        $myProductQP->product_quotation_id = $mypq->id;
        $myProductQP->service_quotation_id = 0;
        $myProductQP->etapa1 = 10;
        $myProductQP->etapa2 = 0;
        $myProductQP->etapa3 = 0;
        $myProductQP->etapa4 = 0;
        $myProductQP->etapa5 = 0;
        $myProductQP->etapa6 = 0;
        
        if(Input::hasFile('file')){ 
        	$count=0;
        	for($i=0; $i<count(Input::file('file')); $i++){
        		$hour = str_replace(":", "", date ("h:i:s"));
        		$Path = "documents_storage/productquotation/".$mypq->folio."/";
        		$Path2 = "documents_storage/productquotation/".$mypq->folio."/".$hour."_".substr(Input::file('file')[$i]->getClientOriginalName(), 0, -(strlen(Input::file('file')[$i]->getClientOriginalExtension()) + 1)).".".Input::file('file')[$i]->getClientOriginalExtension();
        		$createFile = $this->saveFile( Input::file('file')[$i], $Path, $Path2, $mypq->folio, $hour);
        	
        		if($createFile==true){
        			$count++;
        		}
        	}
        	if($count==count(Input::file('file'))){
        		$createFile=true;
        	}
        	
        	if($createFile==true){
        		$mypq->save();
        		$myrevq->product_quotation_id = $mypq->id;
        		$myrevq->save();

                //NUEVO
                $myProductQP->product_quotation_id = $mypq->id;
                $myProductQP->save();
        	}
        }
        else{
        	$createFile=true;
        	$mypq->save();               
        	$myrevq->product_quotation_id = $mypq->id;
        	$myrevq->save();

            $myProductQP->product_quotation_id = $mypq->id;
            $myProductQP->save();
        } 	
        if($createFile==true){
        	return Redirect('quotationproductsview');
        }
    */
}