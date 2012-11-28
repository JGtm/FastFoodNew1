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

	$html .= $this->genererListeProduit($_GET['params']);

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
	    $strListe .= '<table>';
	    $strListe .= '<thead>';
	    $strListe .= '<tr>';
	    $strListe .= '<th>Nos produits</th>';
	    $strListe .= '<th></th>';
	    $strListe .= '<th  width="70">Prix (en €)</th>';
	    $strListe .= '<th>Quantité</th>';
	    $strListe .= '<th>Ajouter à la commande</th>';
	    $strListe .= '</tr>';
	    $strListe .= '</thead>';

	    foreach ($result as $produit)
	    {
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

		$strListeIngredients = substr($strListeIngredients, 0, -2);
		$strListe .= $strListeIngredients;
		$strListe .= '</td><td style="text-align: right; padding: 0 10px;">' . $produit['prix_produit'] . '</td>';
		$strListe .= '<form method="POST" action="?page=' . $_GET['page'] . '&params=' . $_GET['params'] . '">';
		$strListe .= '<td><select name="quantite">';

		for ($j = 0; $j < 6; $j++)
		{
		    $strListe.='<option value="' . $j . '">' . $j . '</option>';
		}

		$strListe .= '</select></td>';
		$strListe .= '<td><input type="submit" name="' . $produit['libelle_produit'] . '" value="Ajouter à la commande" /></td>';
		$strListe .= '</form>';
		$strListe .= '</tr>';
	    }
	}
	elseif ($id_produit != '')
	{
	    $strListe .= '<table>';
	    $strListe .= '<thead>';
	    $strListe .= '<tr>';
	    $strListe .= '<th>Nos produits</th>';
	    $strListe .= '<th></th>';
	    $strListe .= '<th  width="70">Prix (en €)</th>';
	    $strListe .= '<th>Quantité</th>';
	    $strListe .= '<th>Ajouter à la commande</th>';
	    $strListe .= '</tr>';
	    $strListe .= '</thead>';

	    foreach ($result as $produit)
	    {
		$strListe .= '<tr>';
		$strListe .='<td class="listePizza">' . $produit['libelle_produit'] . '</td>';
		$strListe .= '</tr>';

		$strListe .= '<td><img src="' . $produit['image'] . '" style="max-width:125px" /></td>';
		$strListe .= '<td></td>';
		$strListe .= '<td style="text-align: right; padding: 0 10px;">' . $produit['prix_produit'] . '</td>';
		$strListe .= '<form method="POST" action="?page=' . $_GET['page'] . '&params=' . $_GET['params'] . '">';
		$strListe .= '<td><select name="quantite">';

		for ($j = 0; $j < 6; $j++)
		{
		    $strListe.='<option value="' . $j . '">' . $j . '</option>';
		}

		$strListe .= '</select></td>';
		$strListe .= '<td><input type="submit" name="' . $produit['libelle_produit'] . '" value="Ajouter à la commande" /></td>';
		$strListe .= '</form>';
		$strListe .= '</tr>';
	    }
	}

	$strListe .= '</table>';
	$strListe .= '<br />';

	return $strListe;
    }

    function genererFormulaireType()
    {
	$formulaire.='<table>';
	$formulaire.='<tr>';
	$formulaire.= $this->genererListeType('Types_produits');
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


	foreach ($result as $produit)
	{ // chaque ligne du tableau correspondra à un editeur
	    $strListe.='<form method="POST" action="?page=' . $_GET['page'] . '&params=' . $produit['id_type_produit'] . '">';
	    $strListe.='<td><input type="submit" name="selectType" value="' . $produit['libelle_type_produit'] . '" /></td>';
	    $strListe.='</form>';
	}

	$strListe.="</td>";

	return $strListe;
    }

}

?>
