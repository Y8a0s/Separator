<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('isActive'))
{
    function isActive($routeName , $classKey = 'active')
    {
        if(is_array($routeName))
        {
            return in_array( Route::currentRouteName() , $routeName) ? $classKey : '' ;
        }
        return Route::currentRouteName() == $routeName ? $classKey : '' ;
    }
}

if (! function_exists('inRoute'))
{
    function inRoute($routeName)
    {
        if(is_array($routeName))
        {
            return in_array( Route::currentRouteName() , $routeName);
        }
        return Route::currentRouteName() == $routeName;
    }
}