<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function get_login()
    {
        return response()->json([
            'status' => '230',
            'message' => "User not login acccount"

        ]);
    }
    public function Login(ApiLoginRequest $request)
    {
     
        $validated = $request->safe()->only(['email','password']);
        
        if (Auth::attempt(['email' =>$validated['email'], 'password' => $validated['password']])) {
            if (Auth::user()->role_id != 2) {
                return response()->json([
                    'status' => '200',
                    'message' => " admin login successfully"

                ]);
            } else {
                return response()->json([
                    'status' => '202',
                    'message' => " user login succsetfully"

                ]);
            }
        } else {
            return response()->json([
                'status' => '203',
                'message' => "login not successfully"

            ]);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return redirect()->route('get_login')->with('logout', 'abc');
        } else {
            abort(404);
        }
    }

    public function login_web(LoginRequest $request)
    {  
        $validated = $request->safe()->only(['password', 'email']);
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password'] ])) {
            if (Auth::user()->role_id != 2) {
                return view('layouts.app');
            };
        }

        return back()->with('alert','account not found');
    }

    public function get_login_web()
    {
        return view('auth.login');
    }
}
