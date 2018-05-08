<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 11/04/2018
 * Time: 15:12
 */

namespace Tables;


use Core\Table;

class PatientsTable extends Table
{
    protected $id = 'idPatient';


    public function getById($id)
    {
        return $this->query('SELECT p.*, a.GROUPESANGUIN sanguin, a.POIDS poids  FROM PATIENTS p JOIN ANTECEDANTS a ' .
            'WHERE p.IDPATIENT = a.PATIENT AND p.IDPATIENT = ?', [$id], TRUE);
    }


    public function all()
    {
        return $this->query('SELECT p.*, a.GROUPESANGUIN sanguin, a.POIDS poids FROM ' . $this->table . ' p JOIN ANTECEDANTS a ' .
            'WHERE p.IDPATIENT = a.PATIENT ORDER BY p.NAME, p.LASTNAME');
    }

}