<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    use AuthenticatesUsers {
    logout as performLogout;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the authenticated function 
     * if the user is admin, redirect to the admin dashboard
     * if the user is a standard user, redirect to the home page
     * @param Request $request
     * @param User $user
     * @return View view
     */
    protected function authenticated(Request $request, $user)
    {
        if (Auth::User()->is_admin) {
            return redirect(url('admin/dashboard'));
        }else{
            return redirect('/eventList/asc');
        }
    }

    /**
     * Override the logout function to redirect if the user want to change its password
     * if the user come from the profile page, redirect to password/reset
     * @param Request $request 
     * @return View view of the home page
     */
    public function logout(Request $request)
    {
        $this->performLogout($request);
        if (strpos(url()->previous(), 'profile') == true) {
            return redirect('/password/reset');
        }

        return redirect('/eventList/asc');
    }
}
