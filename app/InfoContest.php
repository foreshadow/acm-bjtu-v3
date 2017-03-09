<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoContest extends Model
{
    public static function filter($count = null)
    {
        $query = InfoContest::orderBy('start_time')
                     ->where('start_time', '>=', date('Y-m-d H:i:s', time() - 7200));
        if ($count !== null) {
            $query = $query->take($count);
        }
        $infos = $query->get();
        foreach ($infos as $info) {
            $info['startTimeSeconds'] = strtotime($info['start_time']);
        }

        return $infos;
    }
}
