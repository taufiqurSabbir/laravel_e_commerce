<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WishList\WishRequest;
use App\Models\Wish;
use Illuminate\Support\Facades\DB;

class WishController extends Controller
{
   public function addWish(WishRequest $request){
       Wish::create([
           'user_id' => $request->user()->id,
           'product_id' => $request->product_id
       ]);

       return send_massage('Product added to your wish List',true,200);
   }


   public function allWish(){
       $all_wish = DB::table('products')
           ->select('products.name','products.product_code','products.description','products.color','products.size','products.price','products.isPopular','products.isNew','products.isSpecial','products.Stock','imgaes.image')
           ->join('imgaes','imgaes.product_id','=','products.id')
           ->join('wishes','wishes.product_id','=','products.id')
           ->get();
       return $all_wish;

   }
}
