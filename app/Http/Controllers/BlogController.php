<?php

namespace App\Http\Controllers;

use App\Article;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index')->with('articles', Article::where('public', '=', true)->get());
    }
}
