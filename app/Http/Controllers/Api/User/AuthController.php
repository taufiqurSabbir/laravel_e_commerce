<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GuestLoginRequest;
use App\Http\Requests\User\loginRequest;
use App\Http\Requests\User\RegistationRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function login(loginRequest $request){



        if (!Auth::attempt([
            'phone'=>$request->phone,
            'password'=>$request->password
        ])){
           return response()->json(['massage'=>'The provided credentials are incorrect.'],401);

        }
//        $user = User::where('phone', $request->phone)->first();
        $user = Auth::user();

        $token= $user->createToken('user-token')->plainTextToken;

        return (new AuthResource($user))->additional(['data'=>[
            'token' =>$token,
            'token_type' => 'Bearer'
        ]]);
    }


    public function Register(RegistationRequest $request){


        $user = User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'isGuest'=>false,
            'role'=>'client',
            'city'=>$request->city,
            'shopping_address'=>$request->shopping_address,

        ]);

        $token= $user->createToken('user-token')->plainTextToken;

        return (new AuthResource($user))->additional(['data'=>[
            'token' =>$token,
            'token_type' => 'Bearer'
        ]]);


    }


    public function GuestLogin(GuestLoginRequest $request){



      $user =   User::create([
            'name'=>'guest',
            'phone'=>$request->phone,
            'password'=>bcrypt('123456'),
            'isGuest'=>true,
        ]);
        $token= $user->createToken('user-token')->plainTextToken;

        return (new AuthResource($user))->additional(['data'=>[
            'token' =>$token,
            'token_type' => 'Bearer'
        ]]);


    }
}
