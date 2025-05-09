<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('home');
    }

    public function login() {
        return view('login');
    }

    public function app() {
        return view('app');
    }

    public function filesUpload() {
        return view('files-upload');
    }

    public function fileShow() {
        return view('file-show');
    }
}
