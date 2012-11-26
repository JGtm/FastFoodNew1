<?php

require_once('CUtilisateur.php');

class CEmploye extends CUtilisateur
{

    // --- ASSOCIATIONS ---
    // --- ATTRIBUTES ---
    // --- OPERATIONS ---

    function __construct($nom, $prenom, $email, $mdp)
    {
        parent::__construct($nom, $prenom, $email, $mdp, 'BO');
    }

    public function updateEtatCommande()
    {
        
    }

    public function updateEmploye()
    {
        
    }

}

/* end of class Modele_Modele_employe */
?>