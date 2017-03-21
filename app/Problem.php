<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Problem extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function my()
    {
        return Problem::where('user_id', Auth::id());
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
