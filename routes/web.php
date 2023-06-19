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
    return redirect('home');
});

Auth::routes();
Route::get('menu', [App\Http\Controllers\MenuController::class, 'sideBar'])->name('menu');
Route::middleware(['auth', 'ceklevel:admin,kepala_sekolah'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('kriterias', App\Http\Controllers\KriteriaController::class);
    Route::prefix('kriteriadetails')->group(function () {
        Route::get('/create/{kriteriaId}', [App\Http\Controllers\KriteriadetailController::class, 'create'])->name('kriteriadetails.create');
        Route::get('/{kriteriaId}/{id}/edit', [App\Http\Controllers\KriteriadetailController::class, 'edit'])->name('kriteriadetails.edit');
        Route::get('/{kriteriaId}', [App\Http\Controllers\KriteriadetailController::class, 'index'])->name('kriteriadetails.index');
        Route::get('/{kriteriaId}/{id}', [App\Http\Controllers\KriteriadetailController::class, 'show'])->name('kriteriadetails.show');
        Route::get('/create/{kriteriaId}/{id}/edit', [App\Http\Controllers\KriteriadetailController::class, 'edit'])->name('kriteriadetails.update');
        Route::post('/{kriteriaId}', [App\Http\Controllers\KriteriadetailController::class, 'store'])->name('kriteriadetails.store');
        Route::patch('/{kriteriaId}/{id}', [App\Http\Controllers\KriteriadetailController::class, 'update'])->name('kriteriadetails.update');
        Route::delete('/{kriteriaId}/{id}', [App\Http\Controllers\KriteriadetailController::class, 'destroy'])->name('kriteriadetails.destroy');
    });
    Route::resource('siswas', App\Http\Controllers\SiswaController::class);
    Route::prefix('bantuans')->group(function () {
        Route::get('/proses/{id}', [App\Http\Controllers\BantuanController::class, 'proses'])->name(('bantuans.proses'));
        Route::get('/proses_selesai/{id}', [App\Http\Controllers\BantuanController::class, 'prosesSelesai'])->name(('bantuans.proses_selesai'));
        Route::get('/pdf/{id}', [App\Http\Controllers\BantuanController::class, 'pdf'])->name(('bantuans.pdf'));

    });
    Route::prefix('laporan')->group(function () {
        Route::get('/prestasi', [App\Http\Controllers\LaporanController::class, 'prestasi'])->name('laporan.prestasi');
        Route::get('/nilai', [App\Http\Controllers\LaporanController::class, 'nilai'])->name('laporan.nilai');
        Route::get('/bantuan', [App\Http\Controllers\LaporanController::class, 'bantuan'])->name('laporan.bantuan');
    });
    Route::resource('bantuans', App\Http\Controllers\BantuanController::class);

    Route::prefix('/profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
        Route::patch('/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/image_update', [App\Http\Controllers\ProfileController::class, 'image_update'])->name('profile.image_update');
    });
});
