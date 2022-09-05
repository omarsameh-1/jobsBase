<?php

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;


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

Route::get('/', [JobController::class,'index']);

Route::get('/jobs/create',[JobController::class,'create'])->middleware('auth');

Route::post('/jobs',[JobController::class,'store'])->middleware('auth');

Route::get('/jobs/{job}/edit',[JobController::class,'edit'])->middleware('auth');

Route::put('/jobs/{job}',[JobController::class,'update'])->middleware('auth');

Route::delete('/jobs/{job}',[JobController::class,'destroy'])->middleware('auth');

Route::get('/jobs/manage',[JobController::class,'manage'])->middleware('auth');

//showing a single job by id
Route::get('/jobs/{job}',[JobController::class,'show']);

Route::get('/register',[UserController::class,'create'])->middleware('guest');

Route::post('/users',[UserController::class,'store']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate',[UserController::class,'authenticate']);

