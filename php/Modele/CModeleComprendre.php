<?php

class CModeleComprendre
{

    private $id_commande;
    private $id_produit;
    private $quantite;
    
    function __construct($id_commande, $id_produit, $quantite)
    {
        $this->id_commande = $id_commande;
        $this->id_produit = $id_produit;
        $this->quantite = $quantite;
    }


}

?>
