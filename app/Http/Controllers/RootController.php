<?php

namespace App\Http\Controllers;

use App\Article;
use App\CodeforcesStatus;
use App\InfoContest;
use App\Snippet;
use Auth;

class RootController extends Controller
{
    public function getIndex()
    {
        return view('index')->with('articles', Article::where('public', '=', true)->orderBy('updated_at', 'desc')->get());
    }

    public function getDashboard()
    {
        return view('dashboard')->with('articles', Article::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get())
            ->with('snippets', Snippet::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get())
            ->with('statuses', CodeforcesStatus::where('handle', '=', Auth::user()->handle)->get());
    }

    public function getContest()
    {
        return view('contest')->with('contests', InfoContest::filter());
    }

    public function getPrint()
    {
        return view('print');
    }
}
