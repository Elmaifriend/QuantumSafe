<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;


Route::middleware(['auth'])->group(function () {
    
    Route::post('/files', [FileController::class, 'store'])
        ->name("file.store");

    Route::get("/logout", [UserController::class, "logout"])
        ->name("user.logout");

    Route::get("/files", [FileController::class, "index"])
        ->name("file.index");

    Route::post('/files/upload', [FileController::class, 'upload'])
        ->name('files.upload');

    Route::get('/files/download/{id}', [FileController::class, 'download'])
        ->name('files.download');

});

Route::get("/register", [UserController::class, "create"])
    ->name("user.create");

Route::post("/register", [UserController::class, "store"])
    ->name("user.store");

Route::get("/login", [UserController::class, "login"])
    ->name("login");

Route::post("/login", [UserController::class, "authenticate"])
    ->name("user.authenticate");








