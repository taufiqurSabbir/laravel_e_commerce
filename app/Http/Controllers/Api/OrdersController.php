<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function createOrder(OrderRequest $request){

        $toal_amount = Products::findOrFail($request->product_id)->price*$request->quantity;


        Orders::create([
            'product_id'=>$request->product_id,
            'user_id'=>$request->user()->id,
            'quantity'=>$request->quantity,
            'shipping_address'=>$request->shipping_address,
            'total_price' => $toal_amount
        ]);
        return send_massage('Order placed',true,200);
    }



    public function allOrder(){
//        $order=  DB::table('products')
//            ->select('users.name','users.phone','orders.quantity','orders.shipping_address','products.name','imgaes.image',)
//            ->join('imgaes','imgaes.product_id','=','products.id')
//            ->join('orders','orders.product_id','=','products.id')
//            ->join('users','users.id','=','orders.user_id')
//            ->get();

        $order = DB::table('products')
            ->select('users.name as CustomerName', 'users.phone', 'orders.quantity', 'orders.shipping_address','orders.total_price', 'products.product_code','products.name as productName', 'imgaes.image as productImage')
            ->join('imgaes', 'imgaes.product_id', '=', 'products.id')
            ->join('orders', 'orders.product_id', '=', 'products.id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->get();


        return $order;
    }

}
