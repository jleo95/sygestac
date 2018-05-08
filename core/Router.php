<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 10:43
 */

namespace Core;


class Router
{
    public static function parseUrl($request)
    {
        $url = $request->url;

        if ($url !== null){
            $url = trim($url, '/');
            $urlarray = explode('/', $url);

            $request->controller = (isset($urlarray[0]) AND !empty($urlarray[0])) ? $urlarray[0] : 'index';
            $request->action = (isset($urlarray[1]) AND !empty($urlarray[1])) ? $urlarray[1] : 'index';
            $request->params = array_splice($urlarray, 2);
        }else{
            $request->controller = 'index';
            $request->action = 'index';
        }

    }
}