<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 02:28
 */

namespace Lib;


class Inputs
{


    private $input;
    /**
     * Inputs constructor.
     */
    public function __construct()
    {
        $this->input = new Security();
        if (isset($_POST) AND !empty($_POST)){
            foreach ($_POST as $k => $v) {
                $this->$k = $this->input->post($k);
            }
        }

        if (isset($_GET) AND !empty($_GET)){
            foreach ($_GET as $k) {
                $this->$k = $this->input->post($k);
            }
        }
        if (isset($_FILES) AND !empty($_FILES)){
            foreach ($_FILES as $k => $files) {
                $this->$k = $this->input->file($k);
            }
        }
    }
}