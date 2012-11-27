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
require_once 'php/Modele/CModeleProduit.php';

class CVueProduit
{

    function __construct()
    {
        
    }

    public function getHtml()
    {


        $array = array
            (
            'Nom du produit :' => "libelle_produit",
            'Prix :' => "prix_produit",
            'Description :' => "description",
            'Image :' => "image",
        );
        $lien = '';


        $html = $this->genererFormulaire($array, $lien);

        if (isset($_GET['error']))
        {
            $html .= $this->getError();
        }
        
        $html.='<br>';
        $html.=$this->formulaireSuppProduit();

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

    public function addProduit()
    {
        $newProduit = new CModeleProduit(
                        $_POST['libelle_produit'],
                        $_POST['prix_produit'],
                        $_POST['description'],
                        $_POST['image'],
                        $_POST['Types_produits']
        );

        return $newProduit;
    }

    private function genererFormulaire($array, $lien)
    {
        $formulaire = '';
        $formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
        $formulaire.='<table border = "0">';
        $formulaire.='<tbody>';
        $formulaire.='<tr><td colspan="7"><h3 class="titre">Ajout de produit </h3></td><tr>';
        $formulaire.='<tr>';
        $formulaire.= "<td><label>Type de produit :</label></td>";
        $formulaire.= $this->genererListeType('Types_produits');
        $formulaire.= "<td></td>";
        $formulaire.='</tr>';

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
        $formulaire.= "<td><label>Les bases :</label></td>";
        $formulaire.=$this->genererListeBase('base');
        $formulaire.= "<td colspan='3'><label >Si une base est selectionné vous creer une pizza</label></td>";
        $formulaire.='</tr>';

        $formulaire.='<tr>';
        $formulaire.= "<td><label>Les ingredients :</label></td>";

        for ($i = 0; $i < 4; $i++)
        {
            $formulaire.= $this->genererListeIngredients('ingredient' . $i);
        }
        $formulaire.='</tr>';

        $formulaire.='<tr>';
        $formulaire.='<td><input type="submit" name="add" value="Ajouter" /></td>';

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

    function genererListePizza($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Produits');

        $strListe = '<table>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe .= '<tr>';
            $strListe .='<td>' . $produit['libelle_produit'] . '</td><td>' . $produit['prix_produit'] . '</td><td>' . $produit['id_produit'] . '</td>';
            $strListe .= '</tr>';
        }

        $strListe .= '</table>';

        return $strListe;
    }

    function genererListeType($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Types_produits');

        $strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
        $strListe.='<option selected value="0">Types déja existantes        </option>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe.='<option value="' . $produit['id_type_produit'] . '">' . $produit['libelle_type_produit'] . '</option>';
        }

        $strListe.="</select></td>";

        return $strListe;
    }
    
        function genererListeProduit($className)
    {

        $DB = new CDB();
        $result = $DB->selects('*', 'Produits');

        $strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
        $strListe.='<option selected value="0">Produits déja existants        </option>';

        foreach ($result as $produit)
        { // chaque ligne du tableau correspondra à un editeur
            $strListe.='<option value="' . $produit['id_produit'] . '">' . $produit['libelle_produit'] . '</option>';
        }

        $strListe.="</select></td>";

        return $strListe;
    }
    
    function formulaireSuppProduit()
    {
        $formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
        $formulaire.='<table border = "0">';
        $formulaire.='<tr><td colspan="7"><h3 class="titre">Suppression de produit </h3></td><tr>';
        $formulaire.='<tr>';
        $formulaire.='<td><label>';
        $formulaire.= 'Nom du produit';
        $formulaire.='</label></td>';
        $formulaire.= $this->genererListeProduit('Produits');
        $formulaire.='<td><input type="submit" name="del" value="Supprimer produit" /></td></tr>';
        $formulaire.='</table>';
        $formulaire.='</form>';
        
        return $formulaire;
    }

}

?>
