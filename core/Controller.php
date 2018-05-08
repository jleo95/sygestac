<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 07/04/2018
 * Time: 12:54
 */

namespace Core;


use Lib\BootstrapForm;
use Lib\Inputs;
use Lib\Views;

class Controller
{
    protected $views;
    protected $session;
    protected $request;
    protected $input;
    protected $bootstrap;

    /**
     * Controller constructor.
     */
    public function __construct($request = null)
    {
        $this->views = new Views();
        $this->session = new Session();
        $this->input = new Inputs();
        $this->bootstrap = new BootstrapForm();
        $this->request = $request;

        $urlarr = (isset($_GET['url']) AND !empty($_GET['url'])) ? $_GET['url'] : '';
        $urlarr = explode('/', $urlarr);

        if (!$this->connected() AND $urlarr[0] !== 'connexion'){
            header('Location:' . WEB_URL . 'connexion');
        }

        if ($urlarr[0] != 'connexion'){
//            $_SESSION['activeurl'] = $_GET['url'];
        }

        #laod Table
        $this->laodTable('users');
        $this->laodTable('droits');
        $this->laodTable('pays');
        $this->laodTable('civilites');
        $this->laodTable('groupesanguin');
        $this->laodTable('patients');
        $this->laodTable('antecedants');


        if ($this->connected()){
            $user = $this->Users->getById($this->session->iduser);
            $this->views->assign('user', $user);
            $this->views->setMenu();
        }
    }


    private function connected()
    {
        //var_dump($_SESSION);
        if (isset($this->session->user) AND !empty($this->session->user)){
            return TRUE;
        }
        
        return FALSE;
    }

    protected function laodTable($nameTable)
    {
        $table = ucfirst($nameTable);
        $nameTable = 'Tables' . DS . $table . 'Table';
//        die($nameTable);
        $this->$table = new $nameTable();
    }


    public function ajaxUpdateMenu()
    {
        $idgroupe = $this->input->idgroupe;
        $etatmenu = str_split($this->input->etatmenu);

        if (intval($etatmenu [intval($idgroupe) - 1]) == 0){
            $etatmenu [intval($idgroupe) - 1] = '1';
        }else{
            $etatmenu [intval($idgroupe) - 1] = '0';
        }

        $etatmenu = implode($etatmenu, '');

        if ($this->Users->update(['etatmenu' => $etatmenu], ['iduser' => $this->session->iduser])){
            $_SESSION['etatmenu'] = $this->Users->getById($this->session->iduser)->etatmenu;
        }

    }

    protected function isAuth($key)
    {
        if (in_array($key, $this->droitsuser)){
            return TRUE;
        }

        return FALSE;
    }


}