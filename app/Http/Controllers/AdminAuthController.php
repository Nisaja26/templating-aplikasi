<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    //
    function index()
    {
        return view('admin.auth.login'); 
    }

    function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            Alert::success('Sukses', 'Selamat datang Admin!!');
            return redirect('/admin/dashboard');
        }

        return back()->with('loginError', 'Email atau password salah');
    }

    function logout()  
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return Redirect('login');
    }
}
