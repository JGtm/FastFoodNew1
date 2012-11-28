<?php

require_once 'CHtml.php';
require_once 'php/Modele/CModelePizza.php';
require_once 'php/Modele/CModeleProduit.php';
require_once 'php/Modele/CDB.php';

class CVueListeProduit
{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	$html .= $this->genererFormulaireType();

	$html .= $this->genererListeProduit($id_produit);

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    function genererListeProduit($id_produit)
    {


	$DB = new CDB();
	$requete = 'SELECT DISTINCT
				p.libelle_produit, 
				p.prix_produit, 
				p.id_produit,
				p.image
			    FROM 
				produits p
				INNER JOIN types_produits t ON t.id_type_produit = p.id_type_produit
			    WHERE
				t.id_type_produit LIKE "' . $id_produit . '"';
	$result = $DB->requete($requete);

	if ($id_produit == 1)
	{
	    $strListe = '<form method="POST" action="?page=commander">';
	    $strListe .= '<table>';
	    $strListe .= '<thead>';
	    $strListe .= '<tr>';
	    $strListe .= '<td colspan="3">Les produits </td>';
	    $strListe .= '<td> </td>';
	    $strListe .= '<td>Prix <br />(en €)</td>';
	    $strListe .= '<td>Ajouter <br />à la commande</td>';
	    $strListe .= '<td>Quantité</td>';
	    $strListe .= '</tr>';
	    $strListe .= '</thead>';

	    $i = 0;

	    foreach ($result as $produit)
	    {
		$i++;

		$strListe .= '<tr>';
		$strListe .='<td class="listePizza">' . $produit['libelle_produit'] . '</td>';
		$strListe .= '</tr>';

		$DB = new CDB();
		$ingredients = $DB->requete('SELECT 
				i.libelle 
			    FROM 
				ingredients i 
				INNER JOIN composer c ON c.id_ingredient = i.id_ingredient 
				INNER JOIN produits p ON p.id_pizza = c.id_pizza  
			    WHERE 
				p.libelle_produit LIKE "' . $produit['libelle_produit'] . '"');

		$strListe .= '<tr><td><img src="' . $produit['image'] . '" style="max-width:125px" /></td><td>';
		$strListeIngredients = '';

		foreach ($ingredients as $ingredient)
		{
		    $strListeIngredients .= $ingredient['libelle'] . ', ';
		}

		$strListeIngredients .= substr($strListeIngredients, 0, -2);
		$strListe .= $strListeIngredients;
		$strListe .= '</td><td>' . $produit['prix_produit'] . '</td><td><input type="checkbox" name="id_pizza" value="' . $produit['id_produit'] . '" /></td>';
		$strListe .= '<td><select name="quantite_' . $produit['id_produit'] . '>';

		for ($j = 0; $j < 6; $j++)
		{
		    $strListe.='<option value="' . $j . '">' . $j . '</option>';
		}

		$strListe.="</select></td>";
		$strListe .= '</tr>';
	    }

	    $strListe .= '</table>';
	    $strListe .= '<br />';
	    $strListe .= '<input type="reset" name="annuler" value="Annuler" />';
	    $strListe .= '<input type="submit" name="commander" value="Commander" />';
	    $strListe .= '</form>';

	    return $strListe;
	}
	else
	{
	    
	}
    }

    function genererFormulaireType()
    {
	$formulaire.='<form method="POST" action="?page=' . $_GET['page'] . '">';
	$formulaire.='<table>';
	$formulaire.='<tr>';
	$formulaire.= $this->genererListeType('Types_produits');
	$formulaire.='<td><input type="submit" name="selectType" value="Selectionner" /></td>';
	$formulaire.='</tr>';
	$formulaire.='</table>';
	$formulaire.='<br>';
	$formulaire.='</form>';

	return $formulaire;
    }

    function genererListeType($className)
    {

	$DB = new CDB();
	$result = $DB->selects('*', 'Types_produits');

	$strListe = "<td><select class=" . $className . " name=\"" . $className . "\">";
	$strListe.='<option selected value="0">Les types de produit</option>';

	foreach ($result as $produit)
	{ // chaque ligne du tableau correspondra à un editeur
	    $strListe.='<option value="' . $produit['id_type_produit'] . '">' . $produit['libelle_type_produit'] . '</option>';
	}

	$strListe.="</select></td>";

	return $strListe;
    }

}

?>
