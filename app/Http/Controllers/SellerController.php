<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;
use Illuminate\Support\Str;



use App\Http\Requests\formulaireValidationRequest;

class SellerController extends Controller
{
    //???
    public function Index()
    {
        return view('seller.seller_login');
    } #end method
    public function Dashboard()
    {
        return view('seller.seller_dashboard');
    } #end method
    public function Login(Request $request)
    {
        #
        $request = $request->all();
        //dd($request);
        #
        $credentials = [
            "email" => $request["email"],
            "password" => $request["pass"]
        ];
        if (Auth::guard('seller')->attempt($credentials)) {
            return redirect()->route('seller.dashboard')->with('error', "Bienvenue cher vendeur");
        } else {
            return back()->with('error', 'password or email seller failed');
        }
    } #end method

    public function LogOut()
    {
        Auth::guard("seller")->logout();
        return redirect()->route('seller_login_from')->with("error", "logOut successfully");
    } #end method

    public function Register()
    {
        return view("seller.seller_register");
    } #end method

    public function RegisterCreate(Request $request)
    {

        $request->validate([
            'name' => 'required|name|exists:users',
            'email' => 'required|string|min:4|',
        ]);

        #imposer un control sur les données
        Seller::insert([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),

        ]);
        return redirect()->route('seller_login_from')->with('success', 'Seller created successfully');
    } #end method
    public function Forgot()
    {
        return view("seller.seller_forgot");
    } #end method

    public function ForgotPassword(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        // ]);
        // $token = Str::random(64);

        // DB::table('seller')->insert([
        //     'email' => $request->email,
        //     'token' => $token,
        //     'created_at' => now()
        // ]);

        // return back()->with('success', 'We have e-mailed your password reset link!');
    } #end method
}
