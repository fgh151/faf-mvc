<?php

class Autoloader
{
    public static function load($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        try {
            if(!@include $_SERVER['DOCUMENT_ROOT'] . '../' . $fileName){

            }
        } catch(Exception $e) {
            print_r($e);
        }
    }
}
spl_autoload_register('Autoloader::load');