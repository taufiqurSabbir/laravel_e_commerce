<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Slider\SliderRequest;
use App\Models\Promotions;

class PromotionsController extends Controller
{
  public function addslider(SliderRequest $request){
      $image_name = rand().'.'.$request->slider_image->extension();
      request('slider_image') ->move('image/slider',$image_name);

    Promotions::create([
        'image'=>$image_name
    ]);
    return send_massage('slider added',true,200);
  }
}
