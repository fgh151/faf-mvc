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
    protected $pageContent;
    protected $headStyles;
    protected $headScripts;
    protected $footerScripts;

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
        include $this->applicationPath.'/views/'.$this->viewPath.'/'.$this->view.'.php';
        $this->pageContent = ob_get_clean();

        if(!file_exists($this->applicationPath.'/views/layouts/'.$this->layout.'.php')) {
            include dirname(__FILE__).'/../views/layouts/'.$this->layout.'.php';
        } else {
            include $this->applicationPath . '/views/layouts/' . $this->layout . '.php';
        }

    }

    public function renderContent()
    {
        echo $this->pageContent;
    }

    public function renderHeader()
    {
        foreach($this->headStyles as $media => $styles) {
            foreach($styles as $style) {
                echo '<link rel="stylesheet" media="' . $media . '" href="' . $style . '">'."\n";
            }
        }
        foreach($this->headScripts as $script){
            echo '<script src="'.$script.'"></script>';
        }
    }

    public function renderFooter()
    {
        foreach($this->footerScripts as $script){
            echo '<script src="'.$script.'"></script>';
        }
    }

    public function addStyleSheet($path='', $media = 'all')
    {
        $this->headStyles[$media][] = $path;
    }

    public function addScript($path ='', $position = 'top')
    {
        switch ($position) {
            case 'bottom' : {
                $this->footerScripts[] = $path;
                break;
            }
            default : {
                $this->headScripts[] = $path;
            }
        }
    }
}