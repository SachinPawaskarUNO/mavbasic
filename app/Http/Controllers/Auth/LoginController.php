<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;
use Log;
use Auth;

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
        $this->middleware('guest', ['except' => ['logout']]);
    }

    /**
     * Get the needed authorization credentials from the request.
     * This function overrides the one in traits AuthenticatesUsers.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $request['active'] = true;
        $request['deleted_at'] = null;
        // ToDo: need to incorporate expiration date in the future
        return $request->only($this->username(), 'password', 'active', 'deleted_at');
    }

    /**
     * The user has been authenticated.
     * This function is overridden from Trait AuthenticatesUsers
     * This function is called once the user has been authenticated
     * Do any initialization processing that needs to be done for this user here.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        Log::info('LoginController.authenticated'.$user->name);
        $user->buildWizardStartup();
        $user->buildWizardHelp();

        Session::put('user', $user);
    }
}
