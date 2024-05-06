<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
    public function service()
    {
        $categories = Category::all();
        return view('service', compact('categories'));
    }
    public function about()
    {
        $categories = Category::all();
        return view('about', compact('categories'));
    }
    public function contact()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }
}
