<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 02:50
 */

namespace Controllers;


use Core\Controller;

class IndexController extends Controller
{

    public function index()
    {
//        var_dump($_SESSION);
        $user = $this->Users->getById($this->session->iduser);
        $this->views->assign('user', $user);
        $this->views->setStyle('users' . DS . 'connexion');
        $this->views->setJS('users' . DS . 'user');
        $this->views->render('users' . DS . 'myprofile');
    }

}