<?php

    define('ROOT', dirname(dirname(__FILE__)));
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('DS', DIRECTORY_SEPARATOR);

    require_once ROOT . DS . 'config' . DS . 'inc.php';

    \Core\Autolaoder::laod();

new \Core\Dispatcher();