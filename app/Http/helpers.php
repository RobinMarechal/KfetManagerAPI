<?php

function dateRegexp ()
{
    return '^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$';
}


function singular ($str)
{
    if (ends_with($str, 'ies')) {
        return substr($str, 0, strlen($str) - 3) . 'y';
    }
    else if (ends_with($str, 's')) {
        return substr($str, 0, strlen($str) - 1);
    }

    return $str;
}


function getRelatedModelClassName (\App\Http\Controllers\Controller $controller)
{
    $fullName = get_class($controller);
    $reducedName = str_replace('Controller', '', array_last(explode('\\', $fullName)));

    return 'App\\' . singular($reducedName);
}