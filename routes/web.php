<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/files', [FileController::class, 'store']);

Route::get("/register", [UserController::class, "create"])
    ->name("user.create");

Route::post("/register", [UserController::class, "store"])
    ->name("user.store");

Route::get("/login", [UserController::class, "login"])
    ->name("user.login");



Route::get("/files", [FileController::class, "index"])
    ->name("file.index");