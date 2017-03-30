<?php

function infinity()
{
    return 'Hello infinity!';
}

function in($x, $l, $r)
{
    return $l <= $x && $x <= $r;
}

function code($path)
{
    $prefix = 'public/';
    if (($p = strpos($path, $prefix)) !== false) {
        $path = substr($path, $p + strlen($prefix));
    }
    return '/code/' . $path;
}
