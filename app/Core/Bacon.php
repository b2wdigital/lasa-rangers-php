<?php

namespace Bacon\Core;

class Bacon
{
    public $config;

    public function __construct()
    {
        session_name('Bacon');
        session_start();
        
        $this->requestHandler();
        $this->run();
    }

    public function requestHandler()
    {
        $uri = (isset($_GET["uri"])) ? strtolower($_GET["uri"]) : 'default/index';
        $pieces = explode('/', trim($uri, '/'));
        $this->controller = str_replace(' ', '', ucwords(str_replace('-',' ',array_shift($pieces))));
        $this->action = (isset($pieces[0])) ? array_shift($pieces) : 'index';
        $this->params = array();
        if(count($pieces) % 2 == 0)
        {
            while(count($pieces) > 0)
            {
                $this->params = array(array_shift($pieces) => array_shift($pieces));
            }
        }
        else
        {
            $this->params = $pieces;
        }
    }

    public function run()
    {
        if(file_exists($controller_path = __APP__ . 'Controller/' . $this->controller . 'Controller.php'))
        {
            require_once($controller_path);
            $controller = '\\Bacon\\Controller\\' . $this->controller . 'Controller';
            $this->app = new $controller();
            if (method_exists($this->app, $this->action . 'Action'))
            {
                call_user_func_array(array($this->app, $this->action . 'Action'), array($this->params));
            }
            else
            {
                echo 'noaction:' . $this->action;
            }
        }
        else
        {
            echo 'nocontroller:' . $this->controller;
        }
    }
}
