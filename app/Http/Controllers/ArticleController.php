<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        return view('article.index')->with('articles', Article::where('user_id', '=', Auth::id())->get());
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
        $article->public = ($request->get('public') or false);

        if ($article->save()) {
            return redirect('article')->with('alert', ['message'=>'新建成功', 'type'=>'success', 'icon' => 'ok']);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article->public || (Auth::check() && Auth::id() == $article->user_id)) {
            return view('article.show')->with('article', $article)
                                       ->with('comments', $article->comments);
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
        $article->public = ($request->get('public') or false);

        if ($article->save()) {
            return redirect('article')->with('alert', ['message'=>'修改成功', 'type'=>'success', 'icon' => 'ok']);
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
        return redirect()->back()->withInput()->with('alert', ['message'=>'删除成功', 'type'=>'success', 'icon' => 'ok']);
    }
}
