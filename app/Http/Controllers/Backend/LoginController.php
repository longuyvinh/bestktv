<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('backend.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if( \Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password] , $request->remember) ){
            return redirect()->intended(route('admin.dashboard'));
        }

        //Login fail
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
