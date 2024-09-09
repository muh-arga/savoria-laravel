<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('dashboard');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create.employee');
    Route::post('/create', [EmployeeController::class, 'store'])->name('post.employee');
    Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('edit.employee');
    Route::put('/edit/{employee}', [EmployeeController::class, 'update'])->name('update.employee');
    Route::get('/delete/{employee}', [EmployeeController::class, 'destroy'])->name('delete.employee');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
