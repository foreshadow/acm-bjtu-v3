<?php

namespace App\Http\Controllers;

use \App\Snippet;
use \Illuminate\Http\Request;

class PastebinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        return view('pastebin.create');
        return view('pastebin.index')->with('snippets', Snippet::where('user_id', '=', \Auth::id())->get());
    }

    public function create()
    {
        return view('pastebin.create');
    }

    public function show($id)
    {
        return view('pastebin.show')->with('snippet', Snippet::findOrFail($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'body' => 'required',
        ]);

        $snippet = new Snippet;
        $snippet->title = $request->get('title');
        $snippet->body = $request->get('body');
        $snippet->user_id = $request->user()->id;

        if ($snippet->save()) {
            return redirect("pastebin/$snippet->id")->with('alert', ['message'=>'新建成功', 'type'=>'success', 'icon' => 'ok']);
        } else {
            return redirect()->back()->withInput();
        }
    }
}
