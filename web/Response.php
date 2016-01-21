<?php
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 16:14
 */

namespace mvc\web;


class Response
{
    public static function sendHeader($headers = [])
    {
        if(is_array($headers)) {
            foreach ($headers as $header => $value) {
                header($header . ': ' . $value);
            }
        } elseif(is_string($headers)) {
            header($headers);
        }
    }
}