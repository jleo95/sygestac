<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 00:58
 */

namespace Tables;


use Core\Table;

class UsersTable extends Table
{

    protected $id = 'iduser';

    /**
     * UsersTable constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function logged($login, $pwd)
    {
        $user = $this->query('SELECT * FROM ' . $this->table . ' WHERE username = ?', [$login], TRUE);

        if ($user){
            if ($user->password === $pwd){
                $_SESSION['iduser'] = $user->iduser;
                $_SESSION['user'] = $user->username;
                $_SESSION['profileuser'] = $user->profile;
                $_SESSION['etatmenu'] = $user->etatmenu;
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
}