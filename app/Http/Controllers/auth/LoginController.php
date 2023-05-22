<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ApiLoginRequest;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

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
        
        if (Auth::attempt(['email' =>$validated['email'],'password' => $validated['password']])) {
            $data = Auth::user();
            if(Auth::user()->status == 1){
                if (Auth::user()->role_id == 2 or Auth::user()->role_id == 3 ) {
                    return response()->json([
                        'status' => '200',
                        'message' => " admin login successfully",
                        'data' => $data
                    ]);
                } else {
                    $data = Auth::user();
                    return response()->json([
                        'status' => '202',
                        'message' => " user login succsetfully",
                        'data' => $data
    
                    ]);
                }
            }else{
                return response()->json([
                    'status' => '204',
                    'message' => "account not active "
    
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
            Alert::success('Logout successfully', 'tài khoản đăng xuất thành công');
            return redirect()->route('get_login_web');
        }else {
            abort(404);
        }
    }

    public function login_web(LoginRequest $request)
    {  
      
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
            if (Auth::user()->role_id == 2) {
                if (Auth::user()->status == 1){
                    Alert::success('login successfully', 'tài khoản đăng nhập thành công');
                    return redirect('dashboard');
                }
                Alert::error('Acccount not active ', 'tài khoản chưa được kích hoạt');
                return back();
            } 
            Alert::error('Acccount not have access', 'tài khoản không có quyền truy cập vào trang này');
            return back();
        }
        Alert::error('Login not found', 'tài khoản đăng nhập không thành công');
        return back();
    }

    public function get_login_web()
    {
        return view('auth.login');
    }
}
