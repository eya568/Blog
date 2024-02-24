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
    protected $redirectTo = '/';

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
        'g-recaptcha-response' => 'required',
    ],
    [
        'g-recaptcha-response' => [
            'required' => 'Please verify that you are not a robot.',
            'captcha' => 'Captcha error! try again later or contact site admin.',
        ],
    ],
);
    
    
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the user
    if (auth()->attempt($credentials)) {
        // Check if the user is an admin
        if (auth()->user()->role == "admin") {
            return redirect('adminHome');
        } else {
            return redirect('/');
        }
    } else {
        // Check if the user exists with the provided email
        $user = \App\Models\User::where('email', $input['email'])->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Email is not registered.');
        } else {
            return redirect()->route('login')->with('error', 'Invalid password.');
        }
    }
}


}
