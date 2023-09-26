<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\product\CategoryRequest;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function addcategory(CategoryRequest $request){
            Categories::create([
                'name'=>$request->name,
            ]);

            return send_massage($request->name . ' category created',true,200);
    }
}
