<?php

/**
 * Change Password Controller
 *
 * @category   Users
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Hash;
use Session;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Change Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    /**
     * Changes the password for the current user.
     * Todo: should probably implement a trait ChangePassword
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
                'password' => 'required|min:6|confirmed',
            );

            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return view('auth.passwords.change')->withErrors($validator);
            } else {
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
}
