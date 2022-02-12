<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
