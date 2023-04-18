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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('roles', App\Http\Controllers\RoleController::class);


Route::resource('kriterias', App\Http\Controllers\KriteriaController::class);


Route::resource('kriteriadetails', App\Http\Controllers\KriteriadetailController::class);


Route::resource('siswas', App\Http\Controllers\SiswaController::class);


Route::resource('penilaians', App\Http\Controllers\PenilaianController::class);


Route::resource('penilaianDetails', App\Http\Controllers\PenilaianDetailController::class);
