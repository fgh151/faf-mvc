<?php

namespace mvc\web;

/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 12:02
 */
class Request
{
    public static function getRequest()
    {
        return array_merge($_SERVER, $_REQUEST);
    }
}