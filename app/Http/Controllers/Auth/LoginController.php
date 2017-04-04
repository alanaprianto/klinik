<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function username()
    {
        return 'username';
    }

    public function redirectPath()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return 'admin';
        } elseif ($user->hasRole('loket')) {
            return 'loket';
        } elseif ($user->hasRole('kasir')) {
            return 'kasir';
        } elseif ($user->hasRole('apotek')) {
            return 'apotek';
        } else {
            return 'penata-jasa';
        }

    }
}
