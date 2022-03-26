<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*--------------------------------------------------Admin route---------------------------------------------------------- */

// il faut obligatoirement passé par le préfixe admin pour utiliser l'une des route ici présent
route::prefix('admin')->group(function () {

    //Note Bien : la première des choses a observé une fois arriver au niveau des root sont : nos chemin d'accès
    # qui sont /login, /login/owner, /dashboard puis après on essaye de comprendre a quel controller et quelle action
    # est associé a cette route ensuite on se redirige directement au niveau de controller pour determiner quelle View
    # est appélé suite a l'appele de l'action associer a note controller.    
    route::get('/login', "App\Http\Controllers\AdminController@Index")->name("login_from");
    route::post('/login/owner', 'App\Http\Controllers\AdminController@Login')->name("admin.login");

    #vous ne pouvez pas voir un dashbord tant que vous n'êtes admitrateur et Authentifier
    #nous utiliserons un middleware pour imposer cette contraite. la contraite a déjà été établis voir partis middleware 
    Route::get('/dashboard', "App\Http\Controllers\AdminController@Dashboard")
        ->name('admin.dashboard')
        ->middleware('admin');

    #admin logout
    Route::get('/logout', "App\Http\Controllers\AdminController@LogOut")
        ->middleware('admin')
        ->name('admin.logout');

    #redirect in the  register formulaire
    Route::get('/register', "App\Http\Controllers\AdminController@Register")
        ->name('admin.register');

    #create a new register
    Route::post('/register/create', "App\Http\Controllers\AdminController@RegisterCreate")
        ->name('admin.register.create');
});

/*-------------------------------------------------- End Admin route ---------------------------------------------------------- */

/*----------------------------------------------------- Seller Route -----------------------------------------------------------------*/
route::prefix('seller')->group(function () {

    // par convention route name = prefix.route
    route::get('/login', "App\Http\Controllers\SellerController@Index")
        ->name("seller_login_from");
    route::post('login/owner', "App\Http\Controllers\SellerController@Login")->name('seller.login');

    #logOut
    route::get('/logout', "\App\Http\Controllers\SellerController@LogOut")
        ->name("seller.logout")
        ->middleware("seller");

    route::get("/dashboard", "App\Http\Controllers\SellerController@Dashboard")
        ->middleware('seller')
        ->name('seller.dashboard');

    #register
    route::get('/register', "App\Http\Controllers\SellerController@Register")
        ->name("seller.register");
    route::post('/register/create', "App\Http\Controllers\SellerController@RegisterCreate")
        ->name("seller.register.create");

    #forgot password
    route::get('/forgot', "App\Http\Controllers\SellerController@Forgot")
        ->name("seller.forgot");

    #modify password
    // route::put("/modify/password", "App\Http\Controllers\SellerController@ForgotPassword")
    //     ->name('seller.seller_forgot_password');
});


/*-----------------------------------------------------  End Seller Route -----------------------------------------------------------------*/

#------------------------------------------------------ Don't touch -----------------------------------------------------------#
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
