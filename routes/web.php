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
    return view('home');
})
    ->name('home')
    ->middleware(['2fa']);

Auth::routes();

Route::get('/sessions', [\App\Http\Controllers\Session\SessionIndexController::class, 'index'])->name('sessions.index');
Route::get('/verification', [\App\Http\Controllers\User\VerifyUserController::class, 'verify'])->name('users.verify');

Route::get('users', [\App\Http\Controllers\User\UserIndexController::class, 'index'])->name('users.index');
Route::get('users/create', [\App\Http\Controllers\User\UserCreateController::class, 'create'])->name('users.create');
Route::post('users', [\App\Http\Controllers\User\UserCreateController::class, 'store'])->name('users.store');
Route::get('users/{user}', [\App\Http\Controllers\User\UserShowController::class, 'show'])->name('users.show');
Route::put('users/{user}', [\App\Http\Controllers\User\UserUpdateController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [\App\Http\Controllers\User\UserDeleteController::class, 'destroy'])->name('users.destroy');

Route::get('roles', [\App\Http\Controllers\Role\RoleIndexController::class, 'index'])->name('roles.index');
Route::get('roles/create', [\App\Http\Controllers\Role\RoleCreateController::class, 'create'])->name('roles.create');
Route::post('roles', [\App\Http\Controllers\Role\RoleCreateController::class, 'store'])->name('roles.store');
Route::get('roles/{role}', [\App\Http\Controllers\Role\RoleShowController::class, 'show'])->name('roles.show');
Route::put('roles/{role}', [\App\Http\Controllers\Role\RoleUpdateController::class, 'update'])->name('roles.update');
Route::delete('roles/{role}', [\App\Http\Controllers\Role\RoleDeleteController::class, 'destroy'])->name('roles.destroy');

Route::get('permissions', [\App\Http\Controllers\Permission\PermissionIndexController::class, 'index'])->name('permissions.index');
Route::get('permissions/create', [\App\Http\Controllers\Permission\PermissionCreateController::class, 'create'])->name('permissions.create');
Route::post('permissions', [\App\Http\Controllers\Permission\PermissionCreateController::class, 'store'])->name('permissions.store');
Route::get('permissions/{permission}', [\App\Http\Controllers\Permission\PermissionShowController::class, 'show'])->name('permissions.show');
Route::put('permissions/{permission}', [\App\Http\Controllers\Permission\PermissionUpdateController::class, 'update'])->name('permissions.update');
Route::delete('permissions/{permission}', [\App\Http\Controllers\Permission\PermissionDeleteController::class, 'destroy'])->name('permissions.destroy');

Route::get('2fa', [\App\Http\Controllers\TwoFactorAuth\TwoFactorAuthIndexController::class, 'index'])->name('2fa.index');
Route::post('2fa', [\App\Http\Controllers\TwoFactorAuth\TwoFactorAuthCreateController::class, 'store'])->name('2fa.store');
Route::get('2fa/reset', [\App\Http\Controllers\TwoFactorAuth\TwoFactorAuthResendController::class, 'resend'])->name('2fa.resend');
