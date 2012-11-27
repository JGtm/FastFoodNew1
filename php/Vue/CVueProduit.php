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
require_once 'php/Modele/CModeleProduit.php';

class CVueProduit
{

    function __construct()
    {
        
    }

    public function getHtml()
    {


        $html=$this->genererFormulaireType();


        return $html;
    }

    public function addTypeProduit()
    {

        $newProduit = new CModeleProduit(
                        '',
                        '',
                        '',
                        '',
                        $_POST['type_produit']
        );
        $type = $newProduit->getType_produit();
        return $type;
    }

    public function addProduit()
    {

        $newProduit = new CModeleProduit(
                        $_POST['libelle_produit'],
                        $_POST['prix_produit'],
                        $_POST['description'],
                        $_POST['image'],
                        $_POST['type_produit']
        );

        return $newProduit;
    }

    private function genererFormulaireType()
    {
        $formulaire = '';
        $formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '&params=' . $_POST['libelle_type_produit'] . '">';
        $formulaire.='<table border = "0">';
        $formulaire.='<tbody>';
        $formulaire.='<tr>';
        $formulaire.='<td><label>';
        $formulaire.= 'Type de produit';
        $formulaire.='</label></td>';
        $formulaire.='<td>';
        $formulaire.= $this->genererListeType('Types_produits');
        $formulaire.='</td>';   
        $formulaire.='<td><input type="submit" value="Ok" /></td>';
        $formulaire.='</tr>';
        $formulaire.='</tbody>';
        $formulaire.='</table>';
        $formulaire.='</form>';
        
           
        
   
        
   
        return $formulaire;
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
                $formulaire.='<td colspan="3"><textarea name="' . $value . '"></textarea></td>';
            }
            else
            {
                $formulaire.='<td colspan="3"><input type="text" name="' . $value . '" /></td>';
            }
            $formulaire.='</tr>';
        }


        $formulaire.='<tr>';
        for ($i = 0; $i < 4; $i++)
        {
            $formulaire.= $this->genererListeIngredients('ingredient' . $i);
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

    function genererListeIngredients($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Ingredients');

        $strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
        $strListe.='<option selected value="0">Sélectionnez un ingrédient</option>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe.='<option value="' . $produit['id_ingredient'] . '">' . $produit['libelle'] . '</option>';
        }

        $strListe.="</select></td>";

        return $strListe;
    }

    function genererListeBase($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Bases');

        $strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
        $strListe.='<option selected value="0">Sélectionnez votre base</option>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe.='<option value="' . $produit['id_base'] . '">' . $produit['libelle_base'] . '</option>';
        }

        $strListe.="</select></td>";

        return $strListe;
    }

    function genererListeType($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Types_produits');

        $strListe = "<td><select  class=" . $className . " name=\"" . $className . "\">";
        $strListe.='<option selected value="0">Types déja existantes        </option>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe.='<option value="' . $produit['id_type_produit'] . '">' . $produit['libelle_type_produit'] . '</option>';
        }

        $strListe.="</select></td>";

        return $strListe;
    }

}

?>
