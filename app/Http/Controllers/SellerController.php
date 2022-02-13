<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;
use Carbon\Carbon;



class SellerController extends Controller
{
    public function index()
    {
        return view('seller.seller_login');
    }
    public function dashboard()
    {
        return view('seller.index');
    }

    public function login(Request $request)
    {
        $check = ($request->all());
        if(Auth::guard('seller')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('seller_dashboard')->with('error', 'You are logged in.');
        } else {
            return redirect()->route('seller_login_form')->with('error', 'Invalid email or password.');
        }
    }
    public function sellerLogout()
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_form')->with('error', 'You are logged out.');
    }
    public function sellerRegister()
    {
        return view('seller.seller_register');
    }

    public function sellerRegisterCreate(Request $request)
    {
        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('seller_login_form')->with('error', 'Admin Created Successfully.');
    }

}
