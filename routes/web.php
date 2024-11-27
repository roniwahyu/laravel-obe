<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// Resource routes for all tables
Route::resource('bahan-kajian', \App\Http\Controllers\BahanKajianController::class);
Route::resource('cpl', \App\Http\Controllers\CPLController::class);
Route::resource('cpmk', \App\Http\Controllers\CPMKController::class);
Route::resource('mata-kuliah', \App\Http\Controllers\MataKuliahController::class);
Route::resource('dosen', \App\Http\Controllers\DosenController::class);
Route::resource('program-studi', \App\Http\Controllers\ProgramStudiController::class);
Route::resource('profil-lulusan', \App\Http\Controllers\ProfilLulusanController::class);
Route::resource('mbkm', \App\Http\Controllers\MBKMController::class);
Route::resource('rps', \App\Http\Controllers\RPSController::class);
Route::resource('sub-cpmk', \App\Http\Controllers\SubCPMKController::class);
Route::resource('tahapan-pembelajaran', \App\Http\Controllers\TahapanPembelajaranController::class);
Route::resource('pustaka', \App\Http\Controllers\PustakaController::class);
Route::resource('statistik-aktivitas', \App\Http\Controllers\StatistikAktivitasController::class);
Route::resource('matrik-bk-mk', \App\Http\Controllers\MatrikBKMKController::class);
Route::resource('matrik-cpl-bk', \App\Http\Controllers\MatrikCPLBKController::class);
Route::resource('matrik-cpl-mk', \App\Http\Controllers\MatrikCPLMKController::class);
Route::resource('matrik-cpl-profil', \App\Http\Controllers\MatrikCPLProfilController::class);
Route::resource('matrik-mbkm-cpl', \App\Http\Controllers\MatrikMBKMCPLController::class);
Route::resource('failed-jobs', \App\Http\Controllers\FailedJobController::class);
Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
Route::resource('roles', \App\Http\Controllers\RoleController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::resource('password-reset-tokens', \App\Http\Controllers\PasswordResetTokenController::class);
Route::resource('model-has-permissions', \App\Http\Controllers\ModelHasPermissionController::class);
Route::resource('role-has-permissions', \App\Http\Controllers\RoleHasPermissionController::class);
