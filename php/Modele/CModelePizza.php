<?php

require_once('CModeleProduit.php');
require_once('php/Modele/CDB.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CModelePizza
 *
 * @author Nh3
 */
class CModelePizza extends CModeleProduit
{
    private $ingredients;
    private $id_base = '';
    
    function __construct($libelle, $prix, $description, $image, $type_produit, $ingredients, $id_base)
    {
        parent::__construct($libelle, $prix, $description, $image, $type_produit);
        
        $this->ingredients = $ingredients;
        $this->id_base = $id_base;
        
        $this->DB = new CDB();
    }
    
    public function create() {
        $this->DB->insert('Pizzas', "id_pizza, id_base", "'',".$this->id_base);
        // TODO : trouver le bon ID de la pizza insérée
//        $pid = $this->DB->insert_id('id_pizza','Pizzas');
        $pid = $this->DB->insert_id();
        $this->DB->insert('Produits',
                'id_produit, libelle_produit, prix_produit, description, image, id_type_produit, id_pizza',
                '"", "'.$this->libelle.'", '.$this->prix.', "'.$this->description.'", "'.$this->image.'", '.$this->type_produit.', '.$pid[0]
         );
                
        foreach($this->ingredients as $val) {
            if($val) {
                $this->DB->insert('Composer', "id_pizza, id_ingredient", $pid[0].','.$val);
            }
        }
        
    }

}

?>
