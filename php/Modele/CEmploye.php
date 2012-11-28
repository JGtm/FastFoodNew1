<?php

require_once('CUtilisateur.php');
require_once('CDB.php');

class CEmploye extends CUtilisateur
{

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
    public static function delete($id)
    {
        $table = 'Utilisateurs';
        $condition = 'id_utilisateur ='.$id;
        $DB = new CDB();
        $DB->delete($table,$condition);
    }
    

}

/* end of class Modele_Modele_employe */
?>
