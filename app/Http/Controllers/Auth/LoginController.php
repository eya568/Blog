<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
{
    $input = $request->all();

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // login
    if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
        if (auth()->user()->role == "admin") {
            return redirect('adminHome');
        } else {
            return redirect('home');
        }
    } else {
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }
}

}
