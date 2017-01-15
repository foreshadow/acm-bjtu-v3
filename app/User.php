<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function link()
    {
        return sprintf('<a href="/user/%s">%s</a>', $this->id, $this->name);
    }

    public function url()
    {
        return '/img/' . $this->avatar;
    }

    public function articles()
    {
        return $this->hasmany('App\Article');
    }

    public function publicArticles()
    {
        return $this->articles()->where('public', true);
    }
}
