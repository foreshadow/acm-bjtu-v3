<?php

namespace App\Http\Controllers\OJ;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProblemController extends Controller
{
    public function index()
    {
        return view('oj.problem.index');
    }
}
