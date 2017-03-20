<?php

function markdownify($string)
{
    $array = explode('```', $string);
    for ($i = 0; $i < count($array); $i += 2) {
        $array[$i] = str_replace("\n", "  \n", $array[$i]);
    }
    return (new ParsedownExtensionMathJaxLaTeX())->text(implode('```', $array));
}
