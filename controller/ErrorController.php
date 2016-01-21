<?php
/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 16:04
 */

namespace mvc\controller;


use mvc\web\Response;

class ErrorController extends BaseController
{
    protected $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
        parent::__construct();
        $exceptionCode = $exception->getCode();
        switch ($exceptionCode){
            case 404 : {
                Response::sendHeader("HTTP/1.0 404 Not Found");
            }
        }
    }

    public function renderContent()
    {
        print_r($this->exception);
    }
}