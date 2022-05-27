<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $req){

        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }

        

        return redirect()->back()->with('error', 'Invalid Credentials!');
    }

    public function showLoginForm(){
        return view('auth.login');
    }
}
