<?php
/**
 * Created by PhpStorm.
 * User: leoba
 * Date: 20/08/2017
 * Time: 22:04
 */

 $arrayDay = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
 $arrayMonth  = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aoute', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];


function mailcontrol($mail, $userMail){

    $resultat = '';
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) OR is_numeric($mail)){
        if (is_numeric($mail)){
            if (strlen($mail) >= 8){
                $res = $userMail->getByLogin($mail);
                if ($res){
                    $resultat = 'Adresse mail ou nummero deja utilisé';
                }else{
                    $resultat = 1;
                }
            }else{
                $resultat = 'Le numero de téléphone est incorrecte';
            }
        }else{
            $res = $userMail->getUserForMail($mail);
            if ($res){
                $resultat = 'Adresse mail ou nummero deja utilisé';
            }else{
                $resultat = 2;
            }
        }

    }else{
        $resultat = 'Veuillez entrer une adresse ou numero de telephone correcte';
    }

    return $resultat;
}


function passewordValidate($pwd){
    $regex = preg_match_all('/^[a-zA-Z0-9]+$/', $pwd);

    if ($regex){

        $nbInt = 0;
        $i = 0;

        while (strlen($pwd) > $i AND $nbInt < 2){
            if (is_numeric($pwd[$i])){
                $nbInt ++;
            }

            $i ++;
        }

        if (preg_match_all('/[A-Z]+/', $pwd)){
            if ($nbInt === 2){
                $resultat = 3;
            }else{
                $resultat = 'Votre mot de pase doit contenir au moins deux chiffres';
            }
        }else{
            $resultat = 'Votre mot de passe doit contenir au moins une lettre majuscule';
        }

    }else{
        $resultat = 'Votre mot de passe doit contenir uniquement des chiffres et des lettres';
    }

    return $resultat;

}


function controllerLogin($login) {

    if(preg_match_all('/^[a-zA-Z0-9]+$/', $login)){
        return TRUE;
    } 
    
    return  FALSE;
}

function triUser($idUser, $messages)
{
    $arrayUsers = [];
    $id = '';

    foreach ($messages as $message) {
        if ($message->id_expediteur === $idUser){
            $id = $message->id_destinateur;
        }elseif ($message->id_destinateur === $idUser){
            $id = $message->id_expediteur;
        }

        if (!in_array($id, $arrayUsers)){
            $arrayUsers [] = $id;
        }
    }

    return $arrayUsers;
}

#uploader  les fichier
/**
 * @param $file le fichier
 * @param string $nameFile nouveau nom du fichier
 * @param $path destionation
 * @param array $extention tableau des extension autorisees
 * @param int $maxSize taille max
 * @return array|string
 */
function uploadFile($file, $nameFile = '', $path, $extention = ["jpg","jpeg","png","gif"], $maxSize = 5097152){
    if($file['size'] <= $maxSize){

        $extensionUpload = strtolower(substr(strrchr($file['name'], "."), 1));
        $name_avatar = "";

        if(in_array($extensionUpload, $extention)){

            $name_avatar = $nameFile . "." . $extensionUpload;
            $chemin = $path . DS . '' .$name_avatar;
            $resultat = move_uploaded_file($file['tmp_name'], $chemin);

            if($resultat){
                return [
                    'confirm' => 1,
                    'nameFile' => $name_avatar
                ];
            }

        }else{
            return 'Format invalide.<br> <span>Votre fichier doit être au format : ' . implode(' ou ', $extention) . '</span>';
        }

    }else{
        return 'Fichier tros volumineux. <br><span>Votre fichier ne doit pas depasser : ' . $maxSize / 1024 . 'Mo</span>';
    }
}

#gerate aleatoire
function aleatoire(){
    $table = '';
    for($i = 0; $i < 9; $i++)
            $table .= mt_rand(0,9);
    return $table;
}


function formatDate($date)
{
    $arrayDay = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    $arrayMonth  = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aoute', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    $y = date('Y', strtotime($date));
    $m = date('m', strtotime($date));
    $d = date('d', strtotime($date));

    $mon = $arrayMonth[$m - 1];

    return $d . ' ' . $mon . ' ' . $y;
}


function isAuth($key)
{
    if (in_array($key, $_SESSION['droitsuser'])){
        return TRUE;
    }
    return FALSE;
}

function calculAge ($dateN) {
    $y = date('Y', strtotime($dateN));
    $yAc = date('Y', strtotime(date('Y-m-d')));

    return intval($yAc) - intval($y);
}


#calcucl de temps
function calculTime($tps) {
    $date = date('Y-m-d', strtotime($tps));
    $year = date('Y', strtotime($date));
    $month = date('m', strtotime($date));
    $day = date('d', strtotime($date));
    
    $tps = date('H:i:s', strtotime($tps));
    $hour = date('H', strtotime($tps));
    $minute = date('i', strtotime($tps));
    $second = date('s', strtotime($tps));
    
    #current temp
    $date_cur = date("Y-m-d H:i:s",time());
    $year_cur = date('Y', strtotime($date_cur));
    $month_cur = date('m', strtotime($date_cur));
    $day_cur = date('d', strtotime($date_cur));
    $hour_cur = date('H', strtotime($date_cur));
    $minute_cur = date('i', strtotime($date_cur));
    $second_cur = date('s', strtotime($date_cur));
    
    $my_tps = 'non';
    if($year === $year_cur){
        if($month === $month_cur){
            if ($hour_cur === $hour) {
                if($minute === $minute_cur){
                    $my_tps = $second_cur - $second;
                    $my_tps = $my_tps . ' seconde';
                }else{
                    $my_tps = $minute_cur - $minute;
                    $my_tps = $my_tps . ' minutes';
                }
                
            }  else {
                $my_tps = $hour_cur - $hour;
                $my_tps = $my_tps . 'h';
            }
            
        }
        
    }
    return $my_tps;
}


#remplissage d'une table
function arr_rand($tab1, $tab2){

    $nb = count($tab1) - count($tab2);
    if ($nb < 0){
        $nb = count($tab2) - count($tab1);
        $newTabs = [];
        $tmp = $tab1;

        foreach ($tmp as $tp) {
            $newTabs [] = $tp;
        }

        $tmp = $tab1;
        while ($nb > 0){
            if (empty($tmp)){
                $tmp = $tab1;
            }
            $id = rand(0, count($tmp) - 1);
            $newTabs [] = $tmp [$id];
            unset($tmp[$id]);
            $tmp = array_merge($tmp);
            $nb --;
        }
        return ['tab' => $newTabs, 'type' => 0];
    }elseif ($nb > 0){
        $newTabs = [];
        $tmp = $tab2;
        foreach ($tmp as $tp) {
            $newTabs [] = $tp;
        }

        $tmp = $tab2;
        while ($nb > 0){
            if (empty($tmp)){
                $tmp = $tab2;
            }
            $id = rand(0, count($tmp) - 1);
            $newTabs [] =$tmp [$id];
            unset($tmp[$id]);
            $tmp = array_merge($tmp);
            $nb --;
        }

        return ['tab' => $newTabs, 'type' => 1];
    }
    return ['type' => 2];
}