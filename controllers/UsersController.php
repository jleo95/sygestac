<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 09/04/2018
 * Time: 14:38
 */

namespace Controllers;


use Core\Controller;

class UsersController extends Controller
{


    /**
     * UsersController constructor.
     */
    public function __construct($request = NULL)
    {
        parent::__construct($request);

        $this->views->setStyle('users' . DS . 'connexion');
    }

    public function deconnexion()
    {
        unset($_SESSION['iduser']);
        unset($_SESSION['user']);
        header('Location:' . WEB_URL . 'connexion');
    }


    public function myprofile()
    {
        $this->views->setTitle('Mon profile');
        $this->views->setTitle('Mon profile', 'v');
        $this->views->setJS('users' . DS . 'user');
        $this->views->render('users' . DS . 'myprofile');
    }


    public function ajaxEditAvatar()
    {
        $data = [];

        $file = $this->input->newAvatarFile;

        $nameFile = $this->session->iduser . '_' . aleatoire() . '_' . aleatoire();

        $path = ROOT . DS . 'public' . DS . 'img' . DS . 'avatars' . DS . 'users';

        $resUpload = uploadFile($file, $nameFile, $path);
        $option = [];

        if (isset($resUpload['confirm']) AND $resUpload['confirm'] == 1){

            if ($this->Users->update(['avatar' => $resUpload['nameFile']], ['iduser' => $this->session->iduser])){
                $data['resultat'] = 1;
            }
        }else{
            $data['resultat'] = $resUpload;
        }

        print_r(json_encode($data));
    }

    public function ajaxEditInfosPerso()
    {
        $username = $this->input->newLogin;
        $pwd = sha1($this->input->newPwd);
        $email = $this->input->newEmail;
        $user = $this->Users->getById($this->session->iduser);
        $data = [];

        if ($username !== $user->username){
            $data['username'] = $username;
        }

        if ($pwd !== $user->password){
            $data['password'] = $pwd;
        }

        if ($email !== $user->email){
            $data['email'] = $email;
        }

        if ($this->Users->update($data, ['iduser' => $this->session->iduser])){
            $res['resultat'] = 1;
        }else{
            $res['resultat'] = 'Erreur de mis à jour';
        }

        print_r(json_encode($res));
    }

}