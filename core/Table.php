<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 00:58
 */

namespace Core;


class Table
{
    protected $db;
    protected $table;
    protected $id = 'id';

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Database::instance();

        if (is_null($this->table)){
            $table = get_called_class();
            $table = explode('\\', $table);
            $table = str_replace('Table', '', end($table));
            $this->table = strtoupper($table);
        }
    }

    /**
     * requette generale
     * @param $requete requette
     * @param null $values les argument a passer a la requette
     * @param bool $one nombre de resultat qu'on veux
     * @return array|bool|mixed|\PDOStatement un tableau contenant le resultat
     */

    public function query($requete, $values = NULL, $one = FALSE)
    {
        if ($values === NULL){
            return $this->db->query($requete, $one);
        }else{
            return $this->db->prepare($requete, $values, $one);
        }
    }

    /**
     * recuperation par identifiant de la table
     * @param $id la valeur de l'identifiant
     * @return array|bool|mixed|\PDOStatement resultat de la requete
     */
    public function getById($id)
    {
        return $this->query('SELECT * FROM ' . $this->table . ' WHERE ' . $this->id . ' = ?', [$id], TRUE);
    }

    public function lastId()
    {
        $patient = $this->query('SELECT ' . $this->id . ' FROM ' . $this->table);
        $patient = end($patient);
        $id = $this->id;
        return $patient->$id;
    }



    #mis ajour de la table
    public function update($fields = [], $conds = NULL) {

        $args = [];
        $value = [];
        $arrLogin = ['AND', 'IN', 'OR', ','];
        foreach ($fields as $k => $v){
            $args [] = strtoupper($k) . ' = ?';
            $value [] = $v;
        }

        $args = implode($args, ', ');

        $req = 'UPDATE ' . $this->table . ' SET ' . $args;
        if(!is_null($conds)){
            foreach ($conds as $k => $v) {
                if (in_array($v, $arrLogin)){
                    $cound [] = $v;
                }else{
                    $cound [] = $k . ' = ?';
                    $value [] = $v;
                }
                //echo $v . ' finir la requete udpate ';
            }
            $cound = implode($cound, ' ');
            $req .= ' WHERE ' . $cound;
        }

        return $this->query($req, $value);
    }


    public function all()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }


    /**
     * insere une ou plusieure ligne dans une table;
     * @param array $option les valeur a inseres
     * @return array|bool|mixed|\PDOStatement resultat
     */

    public function insert($option = [])
    {
        foreach ($option as $k => $v) {
            $value [] = $k;
            $args [] = $v;
            $occ [] = '?';
        }

        $value = implode($value, ', ');
        $occ = implode($occ, ',');
        $req = 'INSERT INTO ' . $this->table . ' (' . $value . ') VALUES (' . $occ . ')';
        return $this->query($req, $args, false);
    }

    public function deleteById($id)
    {
        return $this->query('DELETE FROM ' . $this->table . ' WHERE ' . $this->id . ' = ?', [$id]);
    }



}