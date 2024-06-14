<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;

// Route::get('/crud', function () {
//     return view('crud');
// })->name('crud');


Route::get('/', function () {
    return view('login');
});


#Route::get('/home', [LoginController::class, 'main_page'])->name('home');
Route::get('/home', [LoginController::class, 'main_page'])->name('home')->middleware('auth');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
