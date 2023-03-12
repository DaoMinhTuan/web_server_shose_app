<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function get_register()
    {
        return response()->json([
            'status' => '230',
            'message' => "User not login acccount"

        ]);
    }
    public function Register(Request $request)
    {
        try {
            $users = new User;
            $users->fill($request->all);
            $users->roule_id = 2;
            $users->password = Hash::make($request->password);
            $users->save();
            return response()->json([
                'status' => '200',
                'message' => "creat user successfully"
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => '400',
                'message' => "creat at user not successfully"
            ]);
        }
    }
}