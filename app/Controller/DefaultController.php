<?php

namespace Bacon\Controller;

use Bacon\Core\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        require __APP__ . 'View/_header.php';
        require __APP__ . 'View/_home.php';
        require __APP__ . 'View/_footer.php';
    }
}