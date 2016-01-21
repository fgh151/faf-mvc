<?php
namespace mvc\base;
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 15:21
 */
class Object
{
    public function getClassParams()
    {
        return new \ReflectionClass($this->className);
    }
}