<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HRM routes
    Route::get('employees/check-email', [App\Http\Controllers\EmployeeController::class, 'checkEmail'])->name('employees.checkEmail');
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);

    Route::resource('departments', App\Http\Controllers\DepartmentController::class)->only(['index', 'create', 'store']);
    Route::resource('skills', App\Http\Controllers\SkillController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php';
