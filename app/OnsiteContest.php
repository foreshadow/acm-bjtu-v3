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
        $collection1 = $this->registrations()
            ->select(DB::raw('count(*) as count, location2 as location'))
            ->where('location1', '北京交通大学')
            ->groupBy(['location2'])
            ->get();
        $collection2 = $this->registrations()
            ->select(DB::raw('count(*) as count, location1 as location'))
            ->where('location1', '!=', '北京交通大学')
            ->groupBy(['location1'])
            ->get();
        var_dump($collection1);
        var_dump($collection2);
        var_dump($collection1->merge($collection2)->sortByDesc('count'));
        return $collection1->merge($collection2)->sortByDesc('count');
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
