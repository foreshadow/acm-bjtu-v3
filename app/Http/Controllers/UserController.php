<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        return view('user.index')->with('users', User::all());
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show')->with('user', $user)
                                ->with('articles', $user->publicArticles);
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $id,
            'avatar' => 'image|max:1048576'
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->realname = $request->get('realname');
        $user->location1 = $request->get('location1');
        $user->location2 = $request->get('location2');
        $user->handle = $request->get('handle');
        // $user->phone = $request->get('phone');
        if ($request->hasFile('avatar')) {
            $user->avatar = \Storage::disk('img')->put('user', $request->file('avatar'));
        }

        if ($user->save()) {
            return redirect('user/' . $id)->with('alert', ['message'=>'修改成功', 'type'=>'success', 'icon' => 'ok']);
        } else {
            return redirect()->back()->withInput();
        }
    }
}
