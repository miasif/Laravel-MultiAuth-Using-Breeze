<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;



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
/* Admin Route */

Route::prefix('admin')->group(function(){
    Route::get('/login', [AdminController::class,'index'])->name('login_form');
    Route::post('/login/owner', [AdminController::class,'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin_dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class,'adminLogout'])->name('admin.logout')->middleware('admin');

    Route::get('/register', [AdminController::class,'adminRegister'])->name('admin.register');

    Route::post('/register/create', [AdminController::class,'adminRegisterCreate'])->name('admin.register.create');

});



/* End Admin Route */

/* Seller Route */

Route::prefix('seller')->group(function(){
    Route::get('/login', [SellerController::class,'index'])->name('seller_login_form');
    Route::post('/login/owner', [SellerController::class,'login'])->name('seller.login');
    Route::get('/dashboard', [SellerController::class,'dashboard'])->name('seller_dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class,'sellerLogout'])->name('seller.logout')->middleware('seller');

    Route::get('/register', [SellerController::class,'sellerRegister'])->name('seller.register');

    Route::post('/register/create', [SellerController::class,'sellerRegisterCreate'])->name('seller.register.create');

});



/* End Seller Route */


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
