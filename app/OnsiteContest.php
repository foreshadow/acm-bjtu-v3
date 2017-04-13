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
        $query = $this->registrations()
            ->select(DB::raw('count(*) as count, location2 as location'))
            ->where('location1', '北京交通大学')
            ->groupBy(['location2']);
        return $this->registrations()
            ->select(DB::raw('count(*) as count, location1 as location'))
            ->where('location1', '!=', '北京交通大学')
            ->groupBy(['location1'])
            ->union($query)
            ->orderBy('count', 'desc')
            ->get();
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
