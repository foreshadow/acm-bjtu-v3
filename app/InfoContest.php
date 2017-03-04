<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoContest extends Model
{
    public static function filter($count = 4)
    {
        $infos = InfoContest::orderBy('start_time')
                            ->where('start_time', '>=', date('Y-m-d H:i:s', time() - 7200))
                            // ->whereIn('oj', ['Topcoder', 'Codeforces', 'BestCoder', 'Leetcode', 'AtCoder'])
                            ->take($count)->get();
        return $infos;
    }
}
