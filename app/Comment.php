<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Comment extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function info()
    {
        $info = '评论于 ' . partial_relative($this->created_at);
        if ($this->updated_at != $this->created_at) {
            $info .= ' 修改于 ' . partial_relative($this->updated_at);
        }
        return $info;
    }

    public function gfm()
    {
        $a = explode('```', $this->body);
        for ($i = 0; $i < count($a); $i += 2) {
            $a[$i] = str_replace("\n", "  \n", $a[$i]);
        }
        return (new Parsedown())->text(implode('```', $a));
    }
}
