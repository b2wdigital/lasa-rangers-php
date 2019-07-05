<?php

namespace Bacon\Core;

class Controller
{
    public function __construct()
    {
        self::init();
    }

    public function init()
    {
        // workaround
        $config['allow_double_session'] = false;

        if (session_id() === '')
        {
            return session_start();
            $this->setSessionVar('id', session_id());
        }

        if(!$config['allow_double_session'])
        {
            
        }

        $this->sessionDestroy();
    }

    public function doubleSessionCheck()
    {

    }

    public function setSessionVar($_name, $_value)
    {
        $_SESSION[$_name] = $_value;
    }

    public function getSessionVar($_name)
    {
        return $_SESSION[$_name];
    }

    public function sessionDestroy()
    {
        session_destroy();
        //session_regenerate_id();
    }

    public function dumpSession()
    {
        self::init();
        echo nl2br(print_r($_SESSION));
    }
}