<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoContest extends Model
{
    public static function filter()
    {
        $infos = InfoContest::orderBy('start_time')
                            ->where('start_time', '>=', date('Y-m-d H:i:s', time() - 7200))
                            ->whereIn('oj', ['Topcoder', 'Codeforces', 'BestCoder', 'Leetcode', 'AtCoder'])
                            ->take(4)->get();
        return $infos;
    }
}
