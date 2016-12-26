<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            if ($user->hasRole('admin'))
                return view('carousel', compact('user'));
            elseif ($user->hasRole('student'))
                return view('carousel', compact('user'));
            else
                return view('home', compact('user'));
        }
    }

    /**
     * Show the system EULA.
     *
     * @return \Illuminate\Http\Response
     */
    public function eula(Request $request)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            return view('eula', compact('user'));
        }
    }

    /**
     * Show the system EULA.
     *
     * @return \Illuminate\Http\Response
     */
    public function about(Request $request)
    {
        if (Auth::check())
        {
            $uri = $request->path();
            $about = ($uri == 'about') ? true : false;
            $aboutbrowser = ($uri == 'aboutbrowser') ? true : false;
            $user = Auth::user();
            return view('about', ['user' => $user, 'about' => $about, 'aboutbrowser' => $aboutbrowser]);
        }
    }
}
