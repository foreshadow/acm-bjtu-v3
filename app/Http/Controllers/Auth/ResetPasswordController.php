<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $row = DB::table('password_resets')->select('email')->where('token', '=', $token)->first();
        if ($row) {
            return view('auth.passwords.reset')->with('token', $token)->with('email', $row->email);
        } else {
            return redirect('/password/reset')->withInput()->with('alert', ['message' => 'Token无效', 'type' => 'danger', 'icon' => 'remove']);
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $row = DB::table('password_resets')->select('email')->where('token', '=', $request->get('token'))->first();
        if ($row) {
            $email = $row->email;
            DB::table('users')->where('email', '=', $email)->update([
                'password' => bcrypt($request->get('password')),
                'remember_token' => null,
            ]);
            DB::table('password_resets')->where('email', '=', $email)->delete();

            return redirect('/login')->withInput()->with('alert', ['message' => '重置密码成功', 'type' => 'success']);
        } else {
            return redirect('/password/reset')->withInput()->with('alert', ['message' => 'Token无效', 'type' => 'danger', 'icon' => 'remove']);
        }
    }
}
