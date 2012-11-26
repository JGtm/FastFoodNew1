<?php

require_once('CDB.php');
require_once('CUtilisateur.php');

class CClient extends CUtilisateur
{

    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 
    // --- ATTRIBUTES ---

    private $id = '';
    private $adresse = '';
    private $code_postal = '';
    private $telephone = '';
    private $ville = '';

    // --- OPERATIONS ---
    function __construct($nom='', $prenom='', $email='', $mdp='', $adresse='', $code_postal='', $ville='', $telephone='')
    {
        parent::__construct($nom, $prenom, $email, $mdp, 'FO');
                
        $this->nom = $_SESSION['nom'];
        $this->prenom = $_SESSION['prenom'];
        $this->id = $_SESSION['id_utilisateur'];
        $this->email = $_SESSION['email'];
        $this->adresse = $_SESSION['adresse'];
        $this->code_postal = $_SESSION['code_postal'];
        $this->ville = $_SESSION['ville'];
        $this->telephone = $_SESSION['telephone'];
        
    }

    function create()
    {
        $bdd = new CDB();
        $table='Utilisateurs';
        $champs='id_utilisateur,email,mdp,nom,prenom,adresse,code_postal,ville,telephone,qualite';
        $values= "'','".$this->email."','".$this->mdp."','".$this->nom."','".$this->prenom."','".$this->adresse."','".$this->code_postal."','".$this->ville."','".$this->telephone."','".$this->qualite."'";
        
        $bdd->insert($table, $champs, $values);

    }
    

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