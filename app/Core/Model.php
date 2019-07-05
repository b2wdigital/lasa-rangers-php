<?php

namespace Bacon\Core;

use PDO;

class Model
{
    public function db($alias)
    {
        require __APP__ . 'config.php';

        switch ($db[$alias]['type'])
        {
            // the different
            case 'sqlite': 
                return new PDO($db[$alias]['type'] .':' . $db[$alias]['host'] . $db[$alias]['dbname'], $db[$alias]['user'], $db[$alias]['password'], $db[$alias]['options']);
                break;
            // mysql and mssql works fine
            default:
                return new PDO($db[$alias]['type'] .':host=' . $db[$alias]['host'] . ';dbname=' . $db[$alias]['dbname'] . ';charset=' . $db[$alias]['charset'], $db[$alias]['user'], $db[$alias]['password'], $db[$alias]['options']);
                break;
        }
    }
}
