<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\OnsiteContestRegistration as Registration;
use Illuminate\Support\Facades\DB;

class OnsiteContest extends Model
{
    public function registrants()
    {
        return $this->belongsToMany('App\User', 'onsite_contest_registrations');
    }

    public function registrations()
    {
        return $this->hasMany('App\OnsiteContestRegistration');
    }

    public function group()
    {
        return $this->registrations()
            ->select(DB::raw('count(*) as count, location1, location2'))
            ->groupBy(['location1', 'location2'])
            ->orderBy('count', 'desc');
    }

    public function registration(User $user = null)
    {
        if (!Auth::check()) {
            return null;
        }
        if ($user == null && Auth::check()) {
            $user = Auth::user();
        }
        return Registration::where([['user_id', $user->id], ['onsite_contest_id', $this->id]])
            ->first();
    }
}
