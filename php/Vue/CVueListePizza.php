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
				p.id_produit,
				p.image
			    FROM 
				produits p
				INNER JOIN types_produits t ON t.id_type_produit = p.id_type_produit
			    WHERE
				t.libelle_type_produit LIKE "Pizza"');

	$strListe = '<form method="POST" action="?page=commander">';
	$strListe .= '<table>';
	$strListe .= '<tr>';
	$strListe .= '<td> </td>';
	$strListe .= '<td> </td>';
	$strListe .= '<td>Prix <br />(en €)</td>';
	$strListe .= '<td>Ajouter <br />à la commande</td>';
	$strListe .= '<td>Quantité</td>';
	$strListe .= '</tr>';

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

}

?>
