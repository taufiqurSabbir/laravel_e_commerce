<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function createOrder(OrderRequest $request){
        Orders::create([
            'product_id'=>$request->product_id,
            'user_id'=>$request->user()->id,
            'quantity'=>$request->quantity,
            'shipping_address'=>$request->shipping_address,
        ]);
        return send_massage('Order placed',true,200);
    }
}
