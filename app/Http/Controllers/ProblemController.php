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
        $this->middleware('role:bjtuacm');
    }

    public function index()
    {
        // TODO: permission problem in other methods...
        if (Auth::user()->hasRole('admin')) {
            return view('problem.index')->with('problems', Problem::all());
        } else {
            return view('problem.index')->with('problems', Problem::my()->get());
        }
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
        return view('problem.edit')->with('problem', Problem::find($id));
    }

    public function update($id, Request $request)
    {
        $problem = Problem::find($id);
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
                return redirect('problem/' . $id)->with('alert', ['message'=>'修改成功', 'type'=>'success', 'icon' => 'ok']);
            }
        }

        return redirect()->back()->withInput();
    }
}
