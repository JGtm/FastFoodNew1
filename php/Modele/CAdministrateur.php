<?php

require_once('CUtilisateur.php');
require_once ('CDB.php');

class CAdministrateur extends CUtilisateur
{

    // --- ASSOCIATIONS ---
    // --- ATTRIBUTES ---
    private static $instance;
    private $bdd;

    // --- OPERATIONS ---
    public function __construct($nom = '', $prenom = '', $email = '', $mdp = '')
    {
        parent::__construct($nom, $prenom, $email, $mdp, 'SBO');
	$this->nom = $_SESSION['nom'];
        $this->prenom = $_SESSION['prenom'];
        $this->id = $_SESSION['id_utilisateur'];
        $this->email = $_SESSION['email'];
    }

    public static function getInstance()
    {
	if (!isSet(self::$instance))
	{
	    $classe = __CLASS__;
	    self::$instance = new $classe();
	    echo "<br />La classe est instanciee";
	}
	else
	    echo "<br />La classe est deja instanciee";
	return self::$instance;
    }

    public function __clone()
    {
	trigger_error('Le clonage est interdit.', E_USER_ERROR);
    }

   
        

}

/* end of class Modele_Modele_administrateur */
?>
