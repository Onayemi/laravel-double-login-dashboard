<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlutterwaveController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('is_admin')->group(function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('admin/project', [HomeController::class, 'project'])->name('admin.project');
    Route::post('add/project', [HomeController::class, 'addProject'])->name('add.project');
    // Route::get('get/project', [HomeController::class, 'show'])->name('get.project');
    Route::get('get/project/{id}', [HomeController::class, 'show'])->name('get.project');
    Route::get('edit/project/{id}', [HomeController::class, 'edit'])->name('edit.project');
    Route::post('update/project/{id}', [HomeController::class, 'update'])->name('update.project');
    // Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
    
    
    // The route that the button calls to initialize payment
    Route::post('/pay', [FlutterwaveController::class, 'initialize'])->name('pay');
    // The callback url after a payment
    Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('callback');
});

