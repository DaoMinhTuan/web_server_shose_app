<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function get_register_web (){
        return view('auth.register');
    }

    public function register_web (LoginRequest $request){

        return view('auth.login');
    }

    public function get_api_register (){
        return response()->json([
            'status' => '230',
            'message' => "User not login acccount"

        ]);
    }
    public function api_register ( ApiLoginRequest $request){
           
        $validated = $request->safe()->merge([
            'address_id' => 0,
            'role_id' => 1,
            'status' => 0,
            'password' => Hash::make($request->password),
        ]);
        try {
            $users = new User;
            $users->fill($validated->all()); 
            $users->save();
            return response()->json([
                'status' => '200',
                'message' => $users
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => '400',
                'message' => "creat at user not successfully"
            ]);
        }
    }
}
