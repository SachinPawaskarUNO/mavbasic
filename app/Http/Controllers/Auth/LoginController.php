<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use Session;
use App\User;

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
        $this->middleware('guest', ['except' => ['logout', 'changePassword']]);
    }

    // Todo: should probably implemeent a trait ChangePassword and ChnagePasswordController
    /**
     * Updates the password for the current user.
     *
     * @param  void
     * @return void
     */
    public function changePassword()
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $rules = array(
                'old_password' => 'required',
                'password' => 'required|confirmed|min:6',
//                'password' => 'required|alphaNum|between:6,16|confirmed'
            );

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
//                dd(['Validator Failed', $user, $rules, $validator, Input::all()]);
                return view('auth.passwords.change')->withErrors($validator);
//                return view('auth.passwords.change');
            } else {
//                dd(['Validator Success', $user, $rules, $validator, Input::all()]);
                if (!Hash::check(Input::get('old_password'), $user->password)) {
                    return view('auth.passwords.change')->withErrors('Your old password does not match');
                } else {
                    $user->password = bcrypt(Input::get('password'));
                    $user->save();
                    Session::flash('flash_message', 'Password has been changed');
                    return view('auth.passwords.change');
                }
            }
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     * This function overridden the one in traits AuthenticatesUsers.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $request['active'] = true;
        $request['deleted_at'] = null;
        return $request->only($this->username(), 'password', 'active', 'deleted_at');
    }
}
