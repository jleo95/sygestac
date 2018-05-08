<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 12/04/2018
 * Time: 11:23
 */

namespace Lib;


class BootstrapForm
{
    public function btnAction($btn = [], $down = true, $isBtn = true, $elements = [])
    {

/*
        if ($isBtn) {

        }else{
            $str = '<div class=\'btn-group\'>' .
            '<button class="btn btn-' . $btn['type'] . '" ';
            if ($down){
                $str .= 'data-toggle="dropdown"';
            }else{
                $str .= 'data-toggle="droptop"';
            }
            $str .= '><span class="glyphicon glyphicon-' . $btn['icone'] . '"></span>';
            $str .= '</button>';
            $str .= '<ul class="';
            if ($down){
                $str .= 'dropdown-menu>';
            }else{
                $str .= 'droptop-menu>';
            }

            foreach ($elements as $element) {
                $str .= '<li></li>';
            }
        }
*/
        if (isset($_SESSION['droitsuser']) AND !empty($_SESSION['droitsuser'])){
            $droits= $_SESSION['droitsuser'];
            $str = '<div class="btn-group"> 
                      <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span ' .
                      'class="glyphicon-cog glyphicon"></span> <span class="caret"></span></button>' .
                      '<ul class="dropdown-menu">';

            $action = false;

            if (in_array('520', $droits)){
                $str .= '<li><a href="edit"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
                $action = true;
            }else{
                $str .= '<li class="disabled"><a href="edit"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
            }

            $str .= '<li class="divider"></li>';

            if (in_array('521', $droits)){
                $str .= '<li class="danger"><a href="#" data-toggle="modal" data-target="#delete-patient"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
                $action = true;
            }else{
                $str .= '<li class="disabled"><a href="delete"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
            }

            $str .= '</ul>';

            $str .= '</div>';

            if ($action){
                return $str;
            }
            return false;
        }

        return false;
    }

    public function btnPrint()
    {
        if (isset($_SESSION['droitsuser']) AND !empty($_SESSION['droitsuser'])){
            $droits= $_SESSION['droitsuser'];
            $str = '<div class="btn-group"> 
                      <button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><span ' .
                'class="glyphicon-print glyphicon"></span> <span class="caret"></span></button>' .
                '<ul class="dropdown-menu dropdown-menu-right">';

            $action = false;

            if (in_array('204', $droits)){
                $str .= '<li><a href="edit"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
                $action = true;
            }else{
                $str .= '<li class="disabled"><a href="edit"><span class="glyphicon glyphicon-edit"></span> Voir profile</a></li>';
            }

            $str .= '<li class="divider"></li>';

            if (in_array('521', $droits)){
                $str .= '<li class=""><a href="delete"><span class="glyphicon glyphicon-print"></span> Fiche patient</a></li>';
                $action = true;
            }else{
                $str .= '<li class=""><a href="delete"><span class="glyphicon glyphicon-print"></span> Imprimer fiche patient</a></li>';
                $str .= '<li class=""><a href="delete"><span class="glyphicon glyphicon-print"></span> Imprimer fiche patient</a></li>';
                $str .= '<li class=""><a href="delete"><span class="glyphicon glyphicon-print"></span> Imprimer fiche patient</a></li>';
            }

            $str .= '</ul>';

            $str .= '</div>';

            if ($action){
                return $str;
            }
            return false;
        }

        return false;

    }

}