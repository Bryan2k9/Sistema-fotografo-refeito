<?php

use App\Http\Controllers\LikesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Models\Photo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $fotos = Photo::all();

    return view('dashboard', compact('fotos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/fotos', [PhotoController::class, 'store'])->name('foto.save');
    Route::post('fotos/{foto}/like', [LikesController::class, 'store'])->name('foto.like');
});

require __DIR__.'/auth.php';
