<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 12:23
 */

namespace Core;


use Lib\Views;

class Dispatcher
{
    private $request;
    private $url;

    /**
     * Dispatcher constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        Router::parseUrl($this->request);
        $controller = $this->laodController();

        if (!in_array($this->request->action, get_class_methods($controller))){
            $views = new Views();
            $views->errors('404 Not Found', 'La methode ' . $this->request->action . ' n\'existe pas dans le controller ' . ucfirst($this->request->controller) . 'Controller');
        }
        $action = $this->request->action;
        $controller->$action();
    }

    private function laodController()
    {
        $nameController = $this->request->controller;
        $nameController = DS . 'Controllers' . DS . ucfirst($nameController) . 'Controller';
        return new $nameController ($this->request);
    }
}