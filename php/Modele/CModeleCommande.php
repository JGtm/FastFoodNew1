<?php

require_once 'CModeleProduit.php';

class CModeleCommande
{

    //put your code here

    private $id_commande;
    private $date_debut;
    private $date_fin;
    private $montant;
    private $produits;
    private $id_utilisateur;
    private $tab_id_produit;
    private $etat;

    function __construct($id_commande = '', $date_debut = '', $date_fin = '', $montant = '', $produits = '', $id_utilisateur = '')
    {
	$this->id_commande = $id_commande;
	$this->date_debut = $date_debut;
	$this->date_fin = $date_fin;
	$this->montant = $montant;
	$this->produits = $produits;
	$this->id_utilisateur = $id_utilisateur;
    }

    function create()
    {
	
    }

    function ajoutProduit($produit)
    {
	array_push($this->tab_id_produit, $produit);
    }

    public function getId_commande()
    {
	return $this->id_commande;
    }

    public function setId_commande($id_commande)
    {
	$this->id_commande = $id_commande;
    }

    public function getDate_debut()
    {
	return $this->date_debut;
    }

    public function setDate_debut($date_debut)
    {
	$this->date_debut = $date_debut;
    }

    public function getDate_fin()
    {
	return $this->date_fin;
    }

    public function setDate_fin($date_fin)
    {
	$this->date_fin = $date_fin;
    }

    public function getMontant()
    {
	return $this->montant;
    }

    public function setMontant($montant)
    {
	$this->montant = $montant;
    }

    public function getProduits()
    {
	return $this->produits;
    }

    public function setProduits($produits)
    {
	$this->produits = $produits;
    }

    public function getId_utilisateur()
    {
	return $this->id_utilisateur;
    }

    public function setId_utilisateur($id_utilisateur)
    {
	$this->id_utilisateur = $id_utilisateur;
    }

    public function getTab_id_produit()
    {
	return $this->tab_id_produit;
    }

    public function setTab_id_produit($tab_id_produit)
    {
	$this->tab_id_produit = $tab_id_produit;
    }

    public function getEtat()
    {
	return $this->etat;
    }

    public function setEtat($etat)
    {
	$this->etat = $etat;
    }

}

?>
