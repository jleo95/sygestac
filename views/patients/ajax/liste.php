<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 17/04/2018
 * Time: 00:06
 */

    $i = 0;

    foreach ($patients as $patient) {
        ?>
        <tr>
            <td><?php echo ++ $i; ?></td>
            <td><?php echo ucfirst($patient->namePatient) . ' ' . ucfirst($patient->lastnamePatient); ?></td>
            <td>
                <?php
                if ($patient->sexe == 1){
                    echo 'Homme';
                }else{
                    echo 'Femme';
                }
                ?>
            </td>
            <td><?php echo $patient->telPatient; ?></td>
            <td>
                <?php

                if (isAuth('520') OR isAuth('521')){
                    $action = true ;
                }
                $down = 'dropdown';
                if (count($patients) - $i <= 3){
                    $down = 'dropup';
                }
                $btnAction = '<div class="btn-group">' .
                    '<button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span ' .
                    'class="glyphicon-cog glyphicon"></span> <span class="caret"></span></button>' .
                    '<ul class="dropdown-menu">';

                if (isAuth('520')){
                    $btnAction .= '<li onclick="updateId2(' . $patient->idPatient .')"><a href="#" data-toggle="modal" data-target="#update-patient"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
                }else{
                    $btnAction .= '<li class="disabled"><a href="edit"><span class="glyphicon glyphicon-edit"></span> Editer</a></li>';
                }
                $btnAction .= '<li class="divider"></li>';

                if (isAuth('521')){
                    $btnAction .= '<li onclick="updateId(' . $patient->idPatient .')" ><a href="#" data-toggle="modal" data-target="#delete-patient"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
                }else{
                    $btnAction .= '<li class="disabled"><a href="delete"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>';
                }

                $btnAction .= '</ul></div>';

                echo $btnAction;
                ?>
            </td>
        </tr>
        <?php
    }