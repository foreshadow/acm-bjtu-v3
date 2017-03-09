<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\OnsiteContestRegistration as Registration;

class OnsiteContest extends Model
{
    public function registrants()
    {
        return $this->belongsToMany('App\User', 'onsite_contest_registrations');
    }

    public function registration(User $user = null)
    {
        if ($user == null && Auth::check()) {
            $user = Auth::user();
        }
        return Registration::where([['user_id', $user->id], ['onsite_contest_id', $this->id]])
            ->first();
    }
}
