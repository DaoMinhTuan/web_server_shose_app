<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Controllers\mail\MailNotify;

class RegisterController extends Controller
{
    public function get_register_web()
    {
        return view('auth.register');
    }

    public function register_web(LoginRequest $request)
    {

        return view('auth.login');
    }

    public function get_api_register()
    {
        return response()->json([
            'status' => '230',
            'message' => "User not login acccount"

        ]);
    }

    public function confrim_account($token)
    {

        $data = new User;
        try {
            $user = $data->where('token', $token)->first();

            $users = User::find($user->id);
            $users->token = "activation";
            $users->status = 1;
            $users->save();
        } catch (\Exception $err) {
            return redirect('https://mail.google.com/mail/u/0/#inbox');
        }
        return redirect('https://mail.google.com/mail/u/0/#inbox');
    }

    public function api_register(ApiLoginRequest $request)
    {   
       
        $validated = $request->safe()->merge([
                'address_id' => 0,
                'role_id' => 1,
                'status' => 0,
                'token' => md5(uniqid(rand(), true)),
                'avatar' => " no avatar available",
                'password' => Hash::make($request->password),
            ]);
        
        
        
        try {

            $users = new User;
            $users->fill($validated->all());

            
            $users->save();

            $data = [
                'subject' => 'Shose App',
                'body' => 'Welcome to Shose App',
                'token' => $validated['token'],
            ];
            Mail::to($validated['email'])->send(new MailNotify($data));

            return response()->json([
                'status' => '200',
                'message' => 'created successfully'
            ]);
            
        } catch (\Exception $err) {
            return response()->json([
                'status' => '400',
                'message' => "creat at user not successfully"
            ]);
        }
    }

    public function api_admin_register(ApiLoginRequest $request)
    {   
       
        $validated = $request->safe()->merge([
                'address_id' => 0,
                'role_id' => 2,
                'status' => 0,
                'token' => md5(uniqid(rand(), true)),
                'avatar' => " no avatar available",
                'password' => Hash::make($request->password),
        ]);
        
        // try {

            $users = new User;
            $users->fill($validated->all());

            
            $users->save();

            $data = [
                'subject' => 'Shose App',
                'body' => 'Welcome to Shose App',
                'token' => $validated['token'],
            ];
            Mail::to($validated['email'])->send(new MailNotify($data));

            return response()->json([
                'status' => '200',
                'message' => 'created successfully'
            ]);
            
        // } catch (\Exception $err) {
        //     return response()->json([
        //         'status' => '400',
        //         'message' => "creat at user not successfully"
        //     ]);
        // }
    }
}
