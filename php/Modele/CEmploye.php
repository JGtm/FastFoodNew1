<?php

require_once('CUtilisateur.php');

class CEmploye extends CUtilisateur
{

    // --- ATTRIBUTES ---
    private $DB;
    // --- OPERATIONS ---

    function __construct($nom='', $prenom='', $email='', $mdp='')
    {
        parent::__construct($nom, $prenom, $email, $mdp, 'BO');
        
 

    }

    public function create()
    {

        $this->DB = new CDB();
        $table='Utilisateurs';
        $champs="id_utilisateur,email,mdp,nom,prenom,adresse,code_postal,ville,telephone,qualite";
        $values= "'','".$this->email."','".$this->mdp."','".$this->nom."','".$this->prenom."','','','','','".$this->qualite."'";
        
        $this->DB->insert($table, $champs, $values);        
    }


}

/* end of class Modele_Modele_employe */
?>
