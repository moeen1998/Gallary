<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/picture/{id}', [PictureController::class,'add'])->name('picture.store');
Route::delete('picture/{id}/{picture}', [PictureController::class,'destroy'])->name('picture.destroy');

Route::resource('/album', AlbumController::class);
Route::get('/move/{to}/{album}', [AlbumController::class,'moveto'])->name('moveto');

