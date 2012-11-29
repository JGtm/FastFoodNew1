<?php

require_once 'CHtml.php';
require_once 'php/Modele/CModeleProduit.php';

class CVuePizzaPerso
{

    function __construct()
    {
        
    }

    public function getHtml()
    {

        $html = $this->genererFormulaire();

        if (isset($_GET['error']))
        {
            $html .= $this->getError();
        }
        return $html;
    }

    private function genererFormulaire()
    {
        $formulaire = '';
        $formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
        $formulaire.='<table border = "0">';
        $formulaire.='<tbody>';
        $formulaire.='<tr><td colspan="7"><h3 class="titre">Créer votre pizza !</h3></td><tr>';


        $formulaire.='<tr>';
        $formulaire.= "<td><label>Les bases:</label></td>";
        $formulaire.=$this->genererListeBase('base');
        $formulaire.= "<td colspan='3'><label >Si une base est selectionné vous creer une pizza</label></td>";
        $formulaire.='</tr>';

        $formulaire.='<tr>';
        $formulaire.= "<td><label>Les ingredients:</label></td>";

        for ($i = 0; $i < 4; $i++)
        {
            $formulaire.= $this->genererListeIngredients('ingredient' . $i);
        }

        $formulaire.='</tr>';
        
        $formulaire.='<tr>';
        $formulaire.= "<td><label>Quantite :</label></td>";
        $formulaire .= '<td><select name="quantite">';

        for ($j = 0; $j < 6; $j++)
        {
            $formulaire.='<option value="' . $j . '">' . $j . '</option>';
        }

        $formulaire .= '</select></td>';
        $formulaire.='</tr>';

        $formulaire.='<tr>';
        $formulaire.='<td><input type="submit" name="add" value="Commander" /></td>';

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

}

?>
