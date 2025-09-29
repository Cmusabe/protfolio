<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        // Als al ingelogd, direct naar dashboard
        if (Session::get('admin_logged_in')) {
            return redirect('/dashboard');
        }
        
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $adminEmail = 'musabe.coucou@outlook.com';
        $adminPassword = 'admin123';

        Log::info('Login attempt', ['email' => $request->email]);

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Zet de sessie
            Session::put('admin_logged_in', true);
            
            // Forceer sessie opslaan
            Session::save();
            
            Log::info('Admin login success, session gezet', ['session' => Session::all()]);
            
            // Redirect met flash message
            return redirect('/dashboard')->with('success', 'Je bent ingelogd als admin');
        }

        Log::warning('Admin login failed', ['email' => $request->email]);
        return back()->withErrors(['email' => 'Ongeldige admin gegevens']);
    }

    public function logout()
    {
        Session::forget(['admin_logged_in']);
        Session::save();
        return redirect('/');
    }
}
