<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_login');
    }
    public function dashboard()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        $check = ($request->all());
        if(Auth::guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('admin_dashboard')->with('error', 'You are logged in.');
        } else {
            return redirect()->route('login_form')->with('error', 'Invalid email or password.');
        }

    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'You are logged out.');
    }

    public function adminRegister()
    {
        return view('admin.admin_register');
    }
    public function adminRegisterCreate(Request $request)
    {
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('login_form')->with('error', 'Admin Created Successfully.');
    }
}
