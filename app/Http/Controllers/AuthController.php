<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Login as Administrator";
        return view("login", compact('title'));
    }

    public function login(Request $request)
    {
        $msgs = [
            'success' => [
                'Blud berhasil login',
                'Kamu jawa?'
            ],
            'failed' => [
                'Blud tidak terdaftar',
                'Kamu bukan jawa...'
            ]
        ];
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'name' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('user')->attempt($credentials)) {
            $type = 'success';
        } else {
            $type = 'failed';
        }
        
        $randomMessage = $msgs[$type][array_rand($msgs[$type])];
        
        return redirect()->back()->with($type, $randomMessage);
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        return redirect()->back()->with('success', 'Kamu Logout');
    }
}
