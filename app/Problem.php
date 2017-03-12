<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Problem extends Model
{
    public static function my()
    {
        return Problem::where('user_id', Auth::id());
    }

    function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
