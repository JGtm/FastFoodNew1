<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAuthentication
 *
 * @author Nh3
 */
require_once 'CHtml.php';
require_once 'php/Modele/CModelePizza.php';
class CPizza
{ 
  
    function __construct()
    {

    }

    public function getHtml() {
        
        
        $array = array
                    (
                    'Nom du produit :' => "libelle_produit",
                    'Prix :' => "prix_produit",
                    'Description :' => "description",
                    'Image :' => "image",

                );
        $lien = '';
        
        
        $html = $this->genererFormulaire($array, $lien);
        
        if(isset($_GET['error'])) {
            $html .= $this->getError();
        }

      return $html;

    }
    
    public function addPizza()
    {
        $newPizza = new CModelePizza(
                $_POST['libelle_produit'],
                $_POST['prix_produit'],
                $_POST['description'],
                $_POST['image'],
                1,
                Array($_POST['ingredient1'], $_POST['ingredient2'], $_POST['ingredient3'], $_POST['ingredient4']),
                $_POST['base']
        );
        
        return $newPizza;

    }
    
        private function genererFormulaire($array, $lien)
        {
        $formulaire = '';
        $formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
        $formulaire.='<table border = "0">';
        $formulaire.='<tbody>';

        foreach ($array as $key => $value)
        {
            $formulaire.='<tr>';
            $formulaire.='<td><label>';
            $formulaire.= $key;
            $formulaire.='</label></td>';
            if ($value == 'description')
            {
                $formulaire.='<td colspan="3"><textarea name="'.$value.'"></textarea></td>';
            }
            else
            {
                $formulaire.='<td colspan="3"><input type="text" name="'.$value.'" /></td>';
            }
            $formulaire.='</tr>';
        }
        
        
        $formulaire.='<tr>';
        for($i = 0; $i < 4; $i++) {
            $formulaire.= $this->genererListeIngredients('ingredient'.$i);
        }
        $formulaire.='</tr>';
        
        
        $formulaire.='<tr>';
        $formulaire.= $this->genererListeBase('base');
        $formulaire.='</tr>';
        
        
        $formulaire.='<tr>';
        $formulaire.='<td><input type="submit" value="Ajouter" /></td>';
            
        $formulaire.='</tbody>';
        $formulaire.='</table>';
        $formulaire.='</form>';
        
        //$formulaire.='<label id="msg"><?php echo'. $lsMessage.'</label>';

        return $formulaire;
    }
    
    function genererListeIngredients($className) {
        
    $DB = new CDB();
    $result = $DB->selects('*', 'Ingredients');

    $strListe = "<td><select class=".$className." name=\"".$className."\">";
    $strListe.='<option selected value="0">Sélectionnez un ingrédient</option>';
    
    foreach ($result as $produit) { // chaque ligne du tableau correspondra à un editeur

        $strListe.='<option value="' . $produit['id_ingredient'] . '">' . $produit['libelle']  . '</option>';
    }
    
    $strListe.="</select></td>";
    
    return $strListe;
}
function genererListeBase($className) {
        
    $DB = new CDB();
    $result = $DB->selects('*', 'Bases');

    $strListe = "<td><select class=".$className." name=\"".$className."\">";
    $strListe.='<option selected value="0">Sélectionnez votre base</option>';
    
    foreach ($result as $produit) { // chaque ligne du tableau correspondra à un editeur

        $strListe.='<option value="' . $produit['id_base'] . '">' . $produit['libelle_base']  . '</option>';
    }
    
    $strListe.="</select></td>";
    
    return $strListe;
}
    
}

?>
