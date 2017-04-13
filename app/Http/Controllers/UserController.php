<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Ultraware\Roles\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('role:admin')->only(['addRole', 'deleteRole']);
    }

    public function index()
    {
        return view('user.index')->with('users', User::orderBy('active_at', 'desc')->paginate(12));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show')->with('user', $user)
                                ->with('articles', $user->publicArticles);
    }

    public function edit($id)
    {
        if (Auth::id() == $id) {
            return view('user.edit')->with('user', User::find($id));
        } else {
            return redirect()->back()->with('alert', failure('权限不足'));
        }
    }

    public function update($id, Request $request)
    {
        if (Auth::id() != $id) {
            return redirect()->back()->with('alert', failure('权限不足'));
        }

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
            return redirect('dashboard')->with('alert', success('修改成功'));
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function addRole($id, Request $request)
    {
        $user = User::find($id);
        $role = Role::where('slug', $request->get('role'))->first();
        if (in_array($role->name, Auth::user()->assignableRoles($user->id))) {
            if ($user->attachRole($role)) {
                // succeeded but returned false
            } else {
                // return redirect()->back()->with('alert', failure());
            }
            return redirect()->back()->with('alert', success(sprintf('为用户 %s 添加角色 %s 成功', $user->name, $role->name)));
        } else {
            return redirect()->back()->with('alert', failure(sprintf('为用户 %s 添加角色 %s 失败', $user->name, $role->name)));
        }
    }

    public function deleteRole($id, Request $request)
    {
        $user = User::find($id);
        $role = Role::where('slug', $request->get('role'))->first();
        if (Auth::user()->level() > $user->level()) {
            if ($user->detachRole($role)) {
                return redirect()->back()->with('alert', success(sprintf('为用户 %s 删除角色 %s 成功', $user->name, $role->name)));
            } else {
                return redirect()->back()->with('alert', failure(sprintf('为用户 %s 删除角色 %s 失败', $user->name, $role->name)));
            }
        } else {
            return redirect()->back()->with('alert', failure('权限不足'));
        }
    }
}
