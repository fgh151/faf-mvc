<?php

namespace mvc;

use mvc\base\exception\NotFoundException;
use mvc\controller\BaseController;
use mvc\controller\ErrorController;
use mvc\router\Router;
use mvc\web\Request;

class Module
{
    protected $request;
    protected $config;
    protected $application;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
        $this->request = Request::getRequest();
        require 'Autoloader.php';
    }

    public function run()
    {
        if(isset($this->request['r']) && $this->request['r']) {
            $route = Router::run($this->request['r']);
            if (is_array($route)) {
                try {
                    $className = 'controllers\\' . $route[0];
                    if(!class_exists($className)) {
                        throw new NotFoundException();
                    }
                    $controller = new $className();
                    $action = 'actionIndex';
                    if (isset($route[1])) {
                        $action = 'action' . $route[1];
                    }
                    if(!method_exists($controller, $action)) {
                        throw new NotFoundException();
                    }
                    $controller->$action();

                } catch (\Exception $e) {
                    $controller = new ErrorController($e);
                    $controller->actionIndex();
                }
            } else {
                $this->actionDefault();
            }
        } else {
            $this->actionDefault();
        }

    }

    public function actionDefault()
    {
        $controller = new BaseController();
        $action = 'actionIndex';
        $controller->$action();
    }
}