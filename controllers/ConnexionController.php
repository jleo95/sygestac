<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 12:53
 */

namespace Controllers;


use Core\Controller;

class ConnexionController extends Controller
{


    /**
     * ConnexionController constructor.
     */
    public function __construct($request = NULL)
    {
        parent::__construct($request);
    }

    public function index()
    {
        if ($_POST){

            $login = $this->input->login;
            $pwd = $this->input->pwd;

            if ($this->Users->logged($login, sha1($pwd))){
                if (isset($this->session->urlactive) AND !empty($this->session->urlactive)){
                    header('Location:' . $this->session->active);
                }else{
                    header('Location:' . WEB_URL);
                }

            }else{
                $this->views->assign('error', 'Votre login ou mot de passe incorect');
            }
        }

        $this->views->setStyle('users' . DS . 'connexion');
        $this->views->setTitle('connexion');
        $this->views->setTitle('Page de connexion', 'v');
        $this->views->render('users' . DS . 'connexion', TRUE);
    }

}