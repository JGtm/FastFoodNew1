<?php

require_once('CDB.php');
require_once('CUtilisateur.php');

class CClient extends CUtilisateur
{

    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 
    // --- ATTRIBUTES ---
    private $adresse = '';
    private $code_postal = '';
    private $telephone = '';
    private $ville = '';

    // --- OPERATIONS ---
    function __construct($nom='', $prenom='', $email='', $mdp='', $adresse='', $code_postal='', $ville='', $telephone='')
    {
        parent::__construct($nom, $prenom, $email, $mdp, 'FO');
                
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->code_postal = $code_postal;
        $this->ville = $ville;
        $this->telephone = $telephone;
        $this->mdp=$mdp;
        
    }

    function create()
    {
        $bdd = new CDB();
        $table='Utilisateurs';
        $champs="id_utilisateur,email,mdp,nom,prenom,adresse,code_postal,ville,telephone,qualite";
        $values= "'','".$this->email."','".$this->mdp."','".$this->nom."','".$this->prenom."','".$this->adresse."','".$this->code_postal."','".$this->ville."','".$this->telephone."','".$this->qualite."'";
        
        $bdd->insert($table, $champs, $values);

    }
//        public function create()
//    {
//
//        $table = 'Bases';
//        $champs = "id_base,libelle_base";
//        $value = "'','" . $this->libelle_base . "'";
//        $this->DB->insert($table, $champs, $value);
//    }
    

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getCode_postal()
    {
        return $this->code_postal;
    }

    public function setCode_postal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

}

/* end of class Modele_Modele_client */
?>