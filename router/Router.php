<?php

namespace mvc\router;

/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 12:02
 */
class Router
{
    public static function run($route = '')
    {
        if (!$route){
            return 'index';
        } else {
            return explode('/', $route);
        }
    }
}