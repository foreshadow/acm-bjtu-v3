<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnsiteContest as Contest;
use Auth;

class OnsiteContestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['register', 'registerForm']);
        $this->middleware('role:admin', ['except' => ['index', 'show', 'register']]);
    }

    public function index()
    {
        return view('onsite.index')->with('onsites', Contest::all());
    }

    public function show($id)
    {
        $mail = explode('@', Auth::user()->email);
        return view('onsite.show')->with('contest', Contest::find($id))
                                      ->with('bjtu', $mail[1] == 'bjtu.edu.cn' || $mail[1] == 'm.bjtu.edu.cn')
                                      ->with('sid', $mail[0]);
    }

    public function create()
    {
        return view('onsite.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'location' => 'required',
            'begin_register_at' => 'required',
            'end_register_at' => 'required',
            'begin_at' => 'required',
            'end_at' => 'required',
        ]);

        $onsite = new Contest;
        foreach ($request->only([
            'title',
            'location',
            'begin_register_at',
            'end_register_at',
            'begin_at',
            'end_at',
            'body',
            'renderer',
        ]) as $key => $value) {
            $onsite->{$key} = $value;
        }
        if ($onsite->save()) {
            return redirect('onsite');
        } else {
            return redirect()->back()->withInput();
        }
    }

    // unused
    public function edit($id)
    {
        return view('onsite.edit')->with('contest', Contest::find($id));
    }

    // unused
    public function update($id, Request $request)
    {
        return 'update';
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $onsite = Contest::find($id);

        if ($onsite->save()) {
            // return redirect('onsite');
        } else {
            // return redirect()->back()->withInput();
        }
    }
}
