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
    
    function __construct($libelle, $prix, $description, $image, $type_produit)
    {
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->description = $description;
        $this->image = $image;
        $this->type_produit = $type_produit;
    }

}

?>
