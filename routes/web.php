<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect(route('add'));
});

Route::get('/add', function () {
    return Inertia::render('Add');
})->middleware(['auth', 'verified'])->name('add');

Route::get('/list', function () {
    return Inertia::render('List');
})->middleware(['auth', 'verified'])->name('list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user_store', [UserController::class, 'store']);
});

require __DIR__.'/auth.php';
