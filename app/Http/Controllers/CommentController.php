<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        // $request->header('referer');
        $comment = new Comment;
        $comment->user_id = $request->user()->id;
        $comment->article_id = $request->get('article_id');
        $comment->body = $request->get('body');
        if ($comment->save()) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function destroy($id, Request $request)
    {
        $comment = Comment::find($id);
        if ($request->user()->id != $comment->user_id) {
            return redirect()->back();
        } else {
            $comment->delete();
            return redirect()->back()->with('alert', ['message' => '删除评论成功', 'type' => 'success', 'icon' => 'ok']);
        }
    }
}
