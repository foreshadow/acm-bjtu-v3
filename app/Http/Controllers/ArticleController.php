<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        return view('article.index')->with('articles', Article::where('user_id', '=', \Auth::user()->id)->get());
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;
        $article->renderer = $request->get('renderer');
        $article->toc = ($request->get('toc') or false);
        $article->label = ($request->get('label') or false);

        if ($article->save()) {
            return redirect('article');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article->public || (Auth::check() && Auth::user()->id == $article->user_id) {
            return view('article.show')->with('article', $article);
        } else {
            redirect('/');
        }
    }

    public function edit($id)
    {
        return view('article.edit')->with('article', Article::find($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $article = Article::find($id);

        if ($request->user()->id != $article->user_id) {
            return redirect('article');
        }

        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->renderer = $request->get('renderer');
        $article->toc = ($request->get('toc') or false);
        $article->label = ($request->get('label') or false);

        if ($article->save()) {
            return redirect('article');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id, Request $request)
    {
        $article = Article::find($id);
        if ($request->user()->id != $article->user_id) {
            return redirect('article');
        }
        $article->delete();
        return redirect()->back()->withInput();
    }
}
