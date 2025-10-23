<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
Route::get('/', [UserController::class, 'Index'])->name('index');

Route::get('/dashboard', [UserController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/doctors', [UserController::class, 'allDoctors'])->name('alldoctors');
Route::post('/appointment', [UserController::class, 'MakeAnAppointment'])->name('appointment');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/add_doctors', [AdminController::class, 'addDoctors'])->middleware('auth','verified')->name('add_doctors');
    Route::post('/add_doctors', [AdminController::class, 'postAddDoctor'])->middleware('auth','verified')->name('post_add_doctor');
    Route::get('/view_doctors', [AdminController::class, 'viewDoctors'])->middleware('auth','verified')->name('view_doctors');
    Route::get('/delete_doctor/{id}', [AdminController::class, 'deleteDoctor'])->name('delete_doctor');
    Route::get('/update_doctor/{id}', [AdminController::class, 'updateDoctor'])->name('update_doctor');
    Route::post('/post_update_doctor/{id}', [AdminController::class, 'postUpdateDoctor'])->name('post_update_doctor');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
