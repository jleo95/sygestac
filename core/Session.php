<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 13:46
 */

namespace Core;


use Lib\Security;

class Session
{


    private static $is_session;
    private $session;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        self::startSession();

        $this->session = new Security();

        //var_dump($_SESSION);

        foreach ($_SESSION as $k => $v) {
            if ($this->session->session($k) !== '' OR $this->session->session($k) !== FALSE){
                $this->$k = $this->session->session($k);
            }
        }

        //var_dump($this);
    }


    private static function startSession()
    {
        if(self::$is_session === null){
            self::$is_session = session_start();
        }
    }
}