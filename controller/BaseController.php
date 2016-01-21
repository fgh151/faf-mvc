<?php

namespace mvc\controller;
use mvc\base\Object;
use mvc\web\Request;

/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 21.01.16
 * Time: 12:26
 */
class BaseController extends Object
{
    public $layout = 'public';
    public $view = 'index';
    public $viewPath = 'pages';
    public $applicationPath;
    protected $className;

    public function __construct()
    {
        $this->applicationPath = realpath(Request::getRequest()['DOCUMENT_ROOT'].'/../');
        $this->className = get_class($this);
        if(end(explode('\\',$this->className )) !== 'BaseController') {
            $this->viewPath = $this->getClassParams()->getShortName();
        }
    }

    public function actionIndex()
    {
        $this->render();
    }

    public function render($view = 'index')
    {
        $this->view = $view;
        ob_start();
        include $this->applicationPath.'/views/layouts/'.$this->layout.'.php';
        ob_end_flush();
    }

    public function renderContent()
    {
        include $this->applicationPath.'/views/'.$this->viewPath.'/'.$this->view.'.php';
    }
}