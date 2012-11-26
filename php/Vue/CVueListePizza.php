<?php

require_once 'CHtml.php';
require_once 'php/Modele/CModelePizza.php';

class CVueListePizza
{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	$html = $this->genererListePizza();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    function genererListePizza()
    {

	$DB = new CDB();
	$result = $DB->requete('SELECT DISTINCT
				p.libelle_produit, 
				p.prix_produit, 
				p.id_produit
			    FROM 
				produits p');
	
	$strListe = '<table>';
	$strListe .= '<tr>';
	$strListe .= '<td> </td>';
	$strListe .= '<td>Prix</td>';
	$strListe .= '<td> </td>';
	$strListe .= '</tr>';

	foreach ($result as $produit)
	{ // chaque ligne du tableau correspondra à un editeur
	    $strListe .= '<tr>';
	    $strListe .='<td>' . $produit['libelle_produit'] . '</td><td>' . $produit['prix_produit'] . '</td><td>' . $produit['id_produit'] . '</td>';
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
	    
	    $strListe .= '<tr><td>';
	    $strListeIngredients = '';
	    
	    foreach ($ingredients as $ingredient)
	    {
		$strListeIngredients .= $ingredient['libelle'] . ', ';
	    }
	    
	    $strListeIngredients = substr($strListeIngredients, 0, -2);
	    $strListe .= $strListeIngredients;
	    $strListe .= '</td></tr>';
	}

	$strListe .= '</table>';

	return $strListe;
    }

}

?>
