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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\UserController::class, 'setUserRole']);
Route::post('/changeUserRole', [App\Http\Controllers\UserController::class, 'changeUserRole']);
Route::post('/applyForTask', [App\Http\Controllers\UserController::class, 'applyForTask']);
Route::post('/accept/confirm', [App\Http\Controllers\UserController::class, 'confirmStudent']);
Route::post('/english', [App\Http\Controllers\HomeController::class, 'setLocalizationToEng']);
Route::post('/croatian', [App\Http\Controllers\HomeController::class, 'setLocalizationToCro']);
Route::post('/addAssignment', [App\Http\Controllers\TaskController::class, 'addAssignment']);
Route::get('/addAssignment', [App\Http\Controllers\TaskController::class, 'openMenu']);
Route::get('/accept', [App\Http\Controllers\TaskController::class, 'acceptStudent']);
