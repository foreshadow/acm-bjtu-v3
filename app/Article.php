<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ParsedownExtensionMathJaxLaTeX;

class Article extends Model
{
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function info()
    {
        $info = '创建于 '.datetime($this->created_at);
        if ($this->updated_at != $this->created_at) {
            $info .= ' 修改于 '.datetime($this->updated_at);
        }
        return $info;
    }

    public function gfm($excerpt = null)
    {
        if ($excerpt) {
            $a = explode('```', mb_substr($this->body, 0, $excerpt));
        } else {
            $a = explode('```', $this->body);
        }
        for ($i = 0; $i < count($a); $i += 2) {
            $a[$i] = str_replace("\n", "  \n", $a[$i]);
        }
        // return (new Parsedown())->text(implode('```', $a));
        return (new ParsedownExtensionMathJaxLaTeX())->text(implode('```', $a));
    }

    public function excerpt($length = 240)
    {
        return mb_substr($this->body, 0, $length);
    }

    public function text($lines = 5)
    {
        $text = preg_replace('/<.*?>/', '<br>', $this->gfm());
        $text = preg_replace("/<br>\n<br>/", '<br>', $text);
        $array = array_slice(explode('<br>', $text), 1, $lines);

        return implode('<br>', $array);
    }
}
