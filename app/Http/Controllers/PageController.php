<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function app()
    {
        $files = File::where('user_id', Auth::id())->latest()->get();

        return view('app', compact('files'));
    }

    public function filesUpload()
    {
        return view('files-upload');
    }

    public function fileShow()
    {
        return view('file-show');
    }
}
