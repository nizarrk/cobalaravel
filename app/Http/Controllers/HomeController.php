<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $split = [];
        $content = [];
        $files = Storage::disk('local')->files('/');
        foreach ($files as $file) {
            if (Storage::disk('local')->exists($file)) {
                $split = explode(",", Storage::disk('local')->get($file));
                array_push($split, $file);
                array_push($content, $split);
            }
        }
        return view('home', ['files' => $content]);
    }
}
