<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemController extends Controller
{
    function __construct()
    {
        $this->middleware('role:bjtuacm');
    }

    function index()
    {
        return view('problem.index');
    }

    function create()
    {
        return view('problem.create');
    }
}
