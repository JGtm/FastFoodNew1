<?php

class CDB
{
////////////////////////////////////////////
    //Variables/////////////////////////////////
    private $pdo= "";
    private $pilote= "mysql";
    private $host = "localhost"; //serveur
    private $port= "3306";
    private $bdd= "Pizzeria";
    private $user= "root";
    private $mdp= "";

    function __construct()
    {

    }

    private function connect()
    {
        try
        {
            $this->pdo = new PDO($this->pilote . ':host='. ';dbname=' . $this->bdd, $this->user, $this->mdp);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'UTF8'");
        }
        catch (PDOException $e)
        {
            $this->pdo = "Echec de l'exécution : " . $e->getMessage();
        }
        return $this->pdo;
    }

    public function selects($champs, $table, $conditions = '')
    {
        $cnx = $this->connect();
        /* Preparation de la requete de selection en fonction du parametre $conditions */

        $requete = "SELECT $champs FROM $table ";
        if ($conditions != '')
            $requete.=" WHERE $conditions";
        $sql = $cnx->prepare($requete);

        /* Execution de la requete */
        $sql->execute();
        /* On ferme la connection à la base de données */
        $cnx = NULL;
        /* Tant que le fetch() nous retourne un resultat, on le stocke dans $data */
        while ($datas = $sql->fetch())
        {
            /* Pour exploité notre tableau de resultat on le met dans $var qui est un array() */
            $var[] = $datas;
        }
        /* On retourn le tableau */
        if (isset($var))
        {
            return $var;
        }
    }

    public function insert($table, $champs, $values)
    {
        $cnx = $this->connect();
        $sql = $cnx->prepare("INSERT INTO $table ($champs) VALUES ($values)");
        $sql->execute();
    }
    
    public function insert_id()
    {
        $cnx = $this->connect();
        return $cnx->lastInsertId();
    }

    public function update($table, $champsValues, $condition)
    {
        $cnx = $this->connect();
        $sql = $cnx->prepare("UPDATE $table SET $champsValues WHERE $condition");
        $sql->execute();
    }

    public function delete($table, $condition)
    {
        $cnx = $this->connect();
        $sql = $cnx->prepare("DELETE FROM $table WHERE $condition");
        $sql->execute();
    }

}
?>
