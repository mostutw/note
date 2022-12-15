<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    /**
     * Show the form for change password
     */
    public function index()
    {
        return view('pages.change_password');
    }
    /**
     * Update the password for user
     */
    public function update(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
            'new_confirm_passowrd' => 'same:new_password',
        ]);

        User::find(Auth::user()->id)->update(['password' => hash::make($request->new_password)]);

        return view('pages.change_password')->with('messages', '成功');

    }
}
