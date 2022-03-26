<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
/*------------------------------------------- Note Importante ----------------------------------------------------

for the use of a sytem multiple_Authentification you should change this file : config/auth.php, Middleware/Admin,
Models/User =>(add protected $guard = 'Admin';), Http/kernel (add middleware admin..)


-----------------------------------------------------------------------------------------------------------------*/

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.admin_login');
    }

    public function Dashboard()
    {
        return view('admin.index');
    }

    public function Login(Request $request)
    {
        // you can use  dd($check)=> Dump data; for checking that everything working
        // all() => recuperer tout les données dans ma requêtes, et non dans la base de données 


        // $check = $request->all();
        //dd($check);
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        // verification si les données de la data bases sont equivalente au données reçu dans la variable $request a travers le tableau $creadentials 
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('error', 'administrateur authentifier avec success');
        } else {
            return back()->with('error', 'password or email failed');
        }
    }
    public function LogOut()
    {
        Auth::guard('admin')->logout();
        return redirect()->route("login_from")->with('error', 'logOut successfully');
    }
    public function Register()
    {
        return view('admin.admin_register');
    }
    public function RegisterCreate(Request $request)
    {
        //checking
        // dd($request);
        Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),

        ]);
        return redirect()->route('login_from')->with('success', 'admin created successfully');
    } //end method
}
