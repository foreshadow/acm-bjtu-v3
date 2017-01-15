<?php

namespace App;

class Functions
{
    public static function greetings()
    {
        $h = date('G');
        if ($h < 4) {
            // [0, 4)
            return '夜深了';
        } elseif ($h < 10) {
            // [4, 10)
            return '早安';
        } elseif ($h < 13) {
            // [10, 13)
            return '中午好';
        } elseif ($h < 17) {
            // [13, 17)
            return '下午好';
        } elseif ($h < 23) {
            // [17, 23)
            return '晚上好';
        } else {
            // [23, 4)
            return '夜深了';
        }
    }

    public static function datetime($expression)
    {
        return date('y/n/j G:i', strtotime((string)$expression));
    }

    public static function relative_time($timeInterval, $extend = false)
    {
        $suffix = $timeInterval > 0 ? '后' : '前';
        $timeInterval = abs($timeInterval);
        $time = [
            ['text'=>'秒', 'base'=> 60],
            ['text'=>'分钟', 'base'=> 60],
            ['text'=>'小时', 'base'=> 24],
            ['text'=>'天', 'base'=> 7],
            ['text'=>'周', 'base'=> 4],
            ['text'=>'月', 'base'=> 12],
            ['text'=>'年', 'base'=> 3],
            ['text'=>'很久'],
        ];
        foreach ($time as $unit) {
            if ($timeInterval < $unit['base']) {
                $relative = $timeInterval . $unit['text'];
                if (isset($remainder) && $remainder) {
                    $relative .= $remainder;
                }
                return $relative. $suffix;
            } else {
                if ($extend) {
                    $remainder = $timeInterval % $unit['base'] . $unit['text'];
                }
                $timeInterval = floor($timeInterval / $unit['base']);
            }
        }
    }
}
