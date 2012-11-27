<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CModeleProduit
 *
 * @author Nh3
 */
class CModeleProduit
{
    protected $id = '';
    protected $libelle = '';
    protected $prix = '';
    protected $description = '';
    protected $image = '';
    protected $type_produit = '';
    protected $pizza = '';
    
    function __construct($libelle='', $prix='', $description='', $image='', $type_produit='')
    {
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->description = $description;
        $this->image = $image;
        $this->type_produit = $type_produit;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getType_produit()
    {
        return $this->type_produit;
    }

    public function setType_produit($type_produit)
    {
        $this->type_produit = $type_produit;
    }

    public function getPizza()
    {
        return $this->pizza;
    }

    public function setPizza($pizza)
    {
        $this->pizza = $pizza;
    }


}

?>
