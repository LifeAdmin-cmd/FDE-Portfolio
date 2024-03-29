<?php

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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Auth::routes();


Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])->name('complete-registration');

Route::middleware(['2fa'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'],)->name('home');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    Route::get('/test', function () {
        return view('test');
    })->name('test')->middleware('auth');
    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');
});
