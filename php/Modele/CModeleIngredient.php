<?php
require_once('php/Modele/CDB.php');

class CModeleIngredient 
{
    private $libelle;
    private $prix;
    private $DB;
    
    function __construct($libelle, $prix)
    {
        $this->libelle=$libelle;
        $this->prix=$prix;
        $this->DB=new CDB();
    }
    
    public function create() {

        $table='Ingredients';
        $champs="id_ingredient,libelle,prix";
        $value= "'','".$this->libelle."','".$this->prix."'";
        $this->DB->insert($table,$champs ,$value);
    
        
    }
    
        public function delete()
    {

        $table = 'Ingredients';
        $condition = 'id_ingredient ='.$_POST['Ingredients'];
        $this->DB->delete($table,$condition);
    }

    

}

?>
