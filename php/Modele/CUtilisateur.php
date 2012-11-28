<?php

require_once 'CDB.php';

class CUtilisateur
{

    // --- ASSOCIATIONS ---
    // --- ATTRIBUTES ---

    protected $nom = '';
    protected $prenom = '';
    protected $email = '';
    protected $mdp = '';
    protected $qualite = '';

    // --- OPERATIONS ---
    //---Constructeur---
    public function __construct($nom = '', $prenom = '', $email = '', $mdp = '', $qualite = '')
    {
	$this->nom = $nom;
	$this->prenom = $prenom;
	$this->email = $email;
	$this->mdp = $mdp;
	$this->qualite = $qualite;
    }

    //---Getter Setter---
    public function getNom()
    {
	return $this->nom;
    }

    public function setNom($nom)
    {
	$this->nom = $nom;
    }

    public function getPrenom()
    {
	return $this->prenom;
    }

    public function setPrenom($prenom)
    {
	$this->prenom = $prenom;
    }

    public function getEmail()
    {
	return $this->email;
    }

    public function setEmail($email)
    {
	$this->email = $email;
    }

    public function getMdp()
    {
	return $this->mdp;
    }

    public function setMdp($mdp)
    {
	$this->mdp = $mdp;
    }

    public function getQualite()
    {
	return $this->qualite;
    }

    public function setQualite($qualite)
    {
	$this->qualite = $qualite;
    }

}

/* end of abstract class Modele_Modele_utilisateur */
?>