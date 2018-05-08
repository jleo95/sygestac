<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 08/04/2018
 * Time: 00:59
 */

namespace Core;


class Database
{
    private $dbName;
    private $dbUser;
    private $dbPwd;
    private $dbHost;

    private static $pdo;
    private static $db_instance;

    /**
     * Database constructor.
     * @param $dbName
     * @param $dbUser
     * @param $dbPwd
     * @param $dbHost
     */
    public function __construct($dbName, $dbUser, $dbPwd, $dbHost)
    {
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPwd = $dbPwd;
        $this->dbHost = $dbHost;
    }

    public static function instance()
    {
        if (self::$db_instance === NULL){
            self::$db_instance = new Database(DBNAME, DBUSER, DBPWD, DBHOST);
        }

        return self::$db_instance;
    }

    private function pdo()
    {
        if (self::$pdo === NULL){
            $pdo = new \PDO('mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost, $this->dbUser, $this->dbPwd,
                array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$pdo = $pdo;
        }

        return self::$pdo;
    }


    /**
     * requete non preparee
     * @param $requete la requete
     * @param bool $one nombre de ligne qu'on veut avoir
     * @return array|bool|mixed|\PDOStatement tableau des resultat
     */

    public function query($requete, $one = FALSE)
    {
        $this->pdo()->query("SET NAMES UTF8");
        $res = $this->pdo()->query($requete);
        $resultat = $res;

        if (strpos($requete, 'UPDATE') === 0 OR strpos($requete,'DELETE') === 0 OR strpos($requete, 'INSERT') === 0){
            return $resultat;
        }

        $res->setFetchMode(\PDO::FETCH_OBJ);

        if ($one){
            return $res->fetch();
        }else{
            return $res->fetchAll();
        }
    }


    /**
     * requete preparee
     * @param $requete la requete
     * @param $values les valeur a transmetre a la requte
     * @param bool $one nombre des ligne qu'on veut avoir
     * @return array|bool|mixed tableua des resultat
     */
    public function prepare($requete, $values = [], $one = FALSE)
    {
        $this->pdo()->query("SET NAMES UTF8");

        //var_dump($values);
        $res = $this->pdo()->prepare($requete);
        $resultat = $res->execute($values);

        if (strpos($requete, 'UPDATE') === 0 OR strpos($requete,'DELETE') === 0 OR strpos($requete, 'INSERT') === 0){
            return $resultat;
        }

        $res->setFetchMode(\PDO::FETCH_OBJ);

        if ($one){
            $r = $res->fetch();
        }else{
            $r = $res->fetchAll();
        }

        return $r;

    }


}