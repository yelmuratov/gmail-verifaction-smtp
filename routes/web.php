<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
});


// Route::get('/users',[UserController::class,'index'])->name('user.index');
// Route::put('/user-rolechange/{id}', [UserController::class, 'changeUserRole']);
// Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
// Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
// Route::post('/user-store',[UserController::class,'store'])->name('user.store');
// Route::delete('/user-delete/{user}',[UserController::class,'destroy'])->name('user.destroy');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user-delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/user-rolechange/{id}', [UserController::class, 'changeUserRole']);

// Route::resource('user', UserController::class);

Route::get('/code_verify',[MessageController::class,'verify'])->name('code.verify');
Route::post('/codeverify',[MessageController::class,'verify_code'])->name('auth.verify.code');
Route::post('/message/{user}',[MessageController::class,'create'])->name('send.message');

require __DIR__.'/auth.php';
