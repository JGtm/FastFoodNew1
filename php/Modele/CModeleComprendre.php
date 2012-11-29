<?php
require_once 'CDB.php';
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
    
    function returnProduit()
    {
	$DB = new CDB();
        $condition= '"id_produit='.$this->id_produit.'"';
	$values=$DB->selects('*','Produits', $condition);
//'Produits', 'id_produit, libelle_produit, prix_produit, description, image, id_type_produit', '"", "' . $this->libelle . '", "' . $this->prix . '", "' . $this->description . '", "' . $this->image . '", ' . $this->type_produit
        //echo $values[0]['id_produit'];
    }

    public function getId_commande()
    {
        return $this->id_commande;
    }

    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;
    }

    public function getId_produit()
    {
        return $this->id_produit;
    }

    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }





}

?>
