<?php

class CModeleTypeProduit
{

    private $libelle_type_produit;
    private $DB;

    function __construct($libelle_type_produite)
    {
        $this->libelle_type_produit = $libelle_type_produite;
        $this->DB = new CDB();
    }

    public function create()
    {

        $table = 'Types_produits';
        $champs ="id_type_produit,libelle_type_produit";
        $value = "'','" . $this->libelle_type_produit . "'";
        $this->DB->insert($table, $champs, $value);
    }
    
    public function delete()
    {
        $table = 'Types_produits';
        $condition = 'id_type_produit ='.$_POST['Types_produits'];
        $this->DB->delete($table,$condition);
    }
    


}

?>
