<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\product\ProductRequest;
use App\Models\Imgaes;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;

class ProductsController extends Controller
{
    public function productCreate(ProductRequest $request){

        $isPopular = filter_var($request->isPopular, FILTER_VALIDATE_BOOLEAN);
        $isNew = filter_var($request->isNew, FILTER_VALIDATE_BOOLEAN);
        $isSpecial = filter_var($request->isSpecial, FILTER_VALIDATE_BOOLEAN);

        $image_name = rand().'.'.$request->image->extension();
        request('image') ->move('image/product_image',$image_name);


      $product =   Products::create([
            'name'=>$request->name,
            'color'=>json_encode($request->color),
            'size'=>json_encode($request->size),
            'price'=>$request->price,
            'description'=>$request->description,
            'stock'=>$request->stock,
            'isPopular'=>$isPopular,
            'isNew'=>$isNew,
            'isSpecial'=>$isSpecial,
            'category_id'=>$request->category_id,

        ]);

      Imgaes::create(
          [
              'image'=>$image_name,
              'product_id'=>$product->id
          ]
      );

      return send_massage('Product Create successful',true,200);
    }


    public function allproduct(){
        $products=  DB::table('products')
            ->select('products.name','products.description','products.color','products.size','products.price','products.isPopular','products.isNew','products.isSpecial','products.Stock','imgaes.image')
            ->join('imgaes','imgaes.product_id','=','products.id')
            ->get();

        return send_massage($products,true,200);
    }
}
