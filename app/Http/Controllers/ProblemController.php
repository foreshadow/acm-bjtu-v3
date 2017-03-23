<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use Auth;
use Storage;

class ProblemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:bjtuacm');
    }

    public function index()
    {
        // TODO: permission problem in other methods...
        // if (Auth::user()->hasRole('admin')) {
            return view('problem.index')->with('problems', Problem::orderBy('updated_at', 'desc')->get());
        // } else {
        //     return view('problem.index')->with('problems', Problem::my()->get());
        // }
    }

    public function create()
    {
        return view('problem.create');
    }

    public function show($id)
    {
        return view('problem.show')->with('problem', Problem::find($id));
    }

    public function store(Request $request)
    {
        $problem = new Problem;
        $problem->user_id = Auth::id();
        foreach ($request->except(['_token']) as $key => $value) {
            $problem->{$key} = $value;
        }
        if ($problem->save()) {
            if ($request->hasFile('generator')) {
                $file = $request->file('generator');
                $ext = $file->getClientOriginalExtension();
                $problem->generator = $file->storePubliclyAs('public/problem/' . $problem->id, 'generator.' . $ext);
            }
            if ($request->hasFile('solution')) {
                $file = $request->file('solution');
                $ext = $file->getClientOriginalExtension();
                $problem->solution = $file->storePubliclyAs('public/problem/' . $problem->id, 'solution.' . $ext);
            }
            if ($problem->save()) {
                return redirect('problem/' . $problem->id)->with('alert', ['message'=>'新建成功', 'type'=>'success', 'icon' => 'ok']);
            }
        }

        return redirect()->back()->withInput();
    }

    public function edit($id)
    {
        $problem = Problem::find($id);
        if ($problem->user_id == Auth::id() || Auth::user()->hasRole('admin')) {
            return view('problem.edit')->with('problem', $problem);
        } else {
            return redirect('problem')->with('alert', failure('你没有权限这么做'));
        }
    }

    public function update($id, Request $request)
    {
        $problem = Problem::find($id);
        if ($problem->user_id == Auth::id() || Auth::user()->hasRole('admin')) {
            foreach ($request->except(['_token', '_method', 'generator', 'solution']) as $key => $value) {
                $problem->{$key} = $value;
            }
            if ($problem->save()) {
                if ($request->hasFile('generator')) {
                    $file = $request->file('generator');
                    $ext = $file->getClientOriginalExtension();
                    $problem->generator = $file->storePubliclyAs('public/problem/' . $problem->id, 'generator.' . $ext);
                }
                if ($request->hasFile('solution')) {
                    $file = $request->file('solution');
                    $ext = $file->getClientOriginalExtension();
                    $problem->solution = $file->storePubliclyAs('public/problem/' . $problem->id, 'solution.' . $ext);
                }
                if ($problem->save()) {
                    return redirect('problem/' . $id)->with('alert', success('修改成功'));
                }
            }
            return redirect()->back()->withInput()->with('alert', failure('修改失败'));
        } else {
            return redirect('problem')->with('alert', failure('你没有权限这么做'));
        }
    }

    public function destroy($id)
    {
        $problem = Problem::find($id);
        if ($problem->user_id == Auth::id() || Auth::user()->hasRole('admin')) {
            if ($problem->delete()) {
                return redirect('problem')->with('alert', success('删除成功'));
            }
        }

        return redirect('problem')->with('alert', failure('删除失败'));
    }
}
