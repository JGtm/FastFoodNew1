<?php

require_once 'CHtml.php';
require_once 'php/Modele/CModeleBase.php';
require_once 'php/Modele/CModeleIngredient.php';
require_once 'php/Modele/CModeleTypeProduit.php';

class CVueIngreBase
{

    private $cbase;
    private $cingredient;

    function __construct()
    {
	
    }

    public function getHtml()
    {

	$html = $this->genererFormulaireBaseIngredient();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    public function addTypeProduit()
    {
	$newTypeProduit = new CModeleTypeProduit($_POST['libelle_type_produit']);

	return $newTypeProduit;
    }

    public function addBase()
    {
	$newBase = new CModeleBase($_POST['libelle_base']);

	return $newBase;
    }

    public function addIngredient()
    {
	$newIngredient = new CModeleIngredient($_POST['libelle'], $_POST['prix']);

	return $newIngredient;
    }

    private function genererFormulaireBaseIngredient()
    {
	$formulaire = '';
	$formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
	$formulaire.='<table border = "0">';
	$formulaire.='<tbody>';

	$formulaire.='<tr><td colspan="7"><h3 class="titre">Ajout/Suppression de types de produit </h3></td><tr>';
	$formulaire.='<tr>';
	$formulaire.='<td><label>';
	$formulaire.= 'Nom du type:';
	$formulaire.='</label></td>';
	$formulaire.='<td colspan="3"><input type="text" name="libelle_type_produit" /></td>';
	$formulaire.='<td></td>';
	$formulaire.='<td></td>';
	$formulaire.= $this->genererListeType('Types_produits');
	$formulaire.='<td><input type="submit" name="add" value="Ajouter type de produit" /></td>';
	$formulaire.='<td><input type="submit" name="del" value="Supprimer type de produit" /></td></tr>';

	$formulaire.='<tr><td colspan="7"><h3 class="titre">Ajout/Suppression de types de produit d\'ingredients </h3></td><tr>';
	$formulaire.='<tr>';
	$formulaire.='<td><label>';
	$formulaire.= 'Nom de l\'ingredient:';
	$formulaire.='</label></td>';
	$formulaire.='<td colspan="3"><input type="text" name="libelle" /></td>';
	$formulaire.='<td><label>';
	$formulaire.= 'prix:';
	$formulaire.='</label></td>';
	$formulaire.='<td><input type="text" name="prix" /></td>';
	$formulaire.= $this->genererListeIngredients('Ingredients');
	$formulaire.='<td><input type="submit" name="add" value="Ajouter Ingredient" /></td>';
	$formulaire.='<td><input type="submit" name="del" value="Supprimer Ingredient" /></td></tr>';

	$formulaire.='<tr><td colspan="7"><h3 class="titre">Ajout/Suppression de types de bases </h3></td><tr>';
	$formulaire.='<tr>';
	$formulaire.='<td><label>';
	$formulaire.= 'Nom de la base:';
	$formulaire.='</label></td>';
	$formulaire.='<td colspan="3"><input type="text" name="libelle_base" /></td>';
	$formulaire.='<td></td><td></td>';
	$formulaire.= $this->genererListeBase('Bases');
	$formulaire.='<td><input type="submit" name="add" value="AjouterBase        " /></td>';
	$formulaire.='<td><input type="submit" name="del" value="Supprimer Base        " /></td></tr>';

	$formulaire.='</tbody>';
	$formulaire.='</table>';
	$formulaire.='</form>';
	
	return $formulaire;
    }

    function genererListeIngredients($className)
    {

	$DB = new CDB();
	$result = $DB->selects('*', 'Ingredients');

	$strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
	$strListe.='<option selected value="0">Ingrédients déja existants</option>';

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
	$strListe.='<option selected value="0">Bases déja existantes</option>';

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

	$strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
	$strListe.='<option selected value="0">Types déja existantes</option>';

	foreach ($result as $produit)
	{ // chaque ligne du tableau correspondra à un editeur
	    $strListe.='<option value="' . $produit['id_type_produit'] . '">' . $produit['libelle_type_produit'] . '</option>';
	}

	$strListe.="</select></td>";

	return $strListe;
    }

}

?>
