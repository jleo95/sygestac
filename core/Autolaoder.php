<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 10:43
 */

namespace Core;


class Autolaoder
{
    public static function laod(){

        spl_autoload_register(array(__CLASS__, 'autoload'));

    }

    private static function autoload($class)
    {
        $nameClasse = explode('\\', $class);
        $nameClasse = end($nameClasse);
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = __DIR__ . '/' . str_replace(__NAMESPACE__ . '\\', '', $class) . '.php';
        }else{
            $class = dirname(__DIR__) . '/' . str_replace(__NAMESPACE__ . '\\', '', $class) . '.php';
        }

        if (file_exists($class)){
            require $class;
        }else{
            die('404 Not Found : La class ' . $nameClasse . ' est introuvable');
        }
    }

}