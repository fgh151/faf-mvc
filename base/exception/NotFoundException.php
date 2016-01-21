<?php
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 15:40
 */

namespace mvc\base\exception;


class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}