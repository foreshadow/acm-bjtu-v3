<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnsiteContestRegistration as Registration;
use Auth;

class OnlineContestRegistrantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id, Request $request)
    {
        $reg = new Registration;
        $reg->user_id = Auth::id();
        $reg->onsite_contest_id = $id;
        foreach ($request->only([
            'realname',
            'sid',
            'location1',
            'location2',
            'email',
            'phone'
        ]) as $key => $value) {
            $reg->{$key} = $value;
        }
        $ok = false;
        try {
          $ok = $reg->save();
        } finally {
            if ($ok) {
                return redirect()->back()->with('alert', ['message'=>'报名成功', 'type'=>'success', 'icon' => 'ok']);
            } else {
                return redirect()->back()->with('alert', ['message'=>'报名失败，已经报名？', 'type'=>'danger', 'icon' => 'remove']);
            }
        }
    }

    public function update($id, Request $request)
    {
        $reg = Registration::find($id);
        if ($reg->user_id == Auth::id()) {
            foreach ($request->only([
                'email',
                'phone'
            ]) as $key => $value) {
                $reg->{$key} = $value;
            }
            if ($reg->save()) {
                return redirect()->back()->with('alert', ['message'=>'修改成功', 'type'=>'success', 'icon' => 'ok']);
            } else {
                return redirect()->back()->with('alert', ['message'=>'修改失败', 'type'=>'danger', 'icon' => 'remove']);
            }
        }
    }
}
