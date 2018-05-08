<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 10:44
 */

namespace Core;


use Lib\Security;

class Request
{
    public $url;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = (isset($_GET['url']) AND !empty($_GET['url'])) ? $_GET['url'] : null;
    }


}