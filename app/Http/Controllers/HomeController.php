<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $permission_list = !empty($user['permission']) ? json_decode($user['permission'],true) :  [] ;
        $binding = [
            'user' => $user,
            'permission_list' => $permission_list,
        ];
        // dd($binding);
        return view('home',$binding);
    }
}
