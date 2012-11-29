<?php

require_once 'php/Modele/CModeleCommande.php';
require_once 'php/Modele/CDB.php';

class CVueCommander
{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	$html = $this->affichageCommande();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    function affichageCommande()
    {
	$objectCommande = unserialize($_SESSION['commande']);
	$produitCmd = $objectCommande->getLesComprendres();

	foreach ($produitCmd AS $values)
	{
	    $DB = new CDB();
	    $result = $DB->requete('SELECT libelle_produit, prix_produit FROM produits WHERE id_produit = ' . $values->getId_produit());

	    foreach ($result AS $pizza)
	    {
		$tabCommande['libelle_produit'] = $pizza['libelle_produit'];
		$tabCommande['prix_produit'] = $pizza['prix_produit'];
		$tabCommande['quantite_produit'] = $values->getQuantite();
	    }
	}
	
	if (isset($_GET['params']))
	{
	    $_SESSION['panier'] [] = $tabCommande;
	}
	
	$commande = '<table>';
	$commande .= '<tr>';
	$commande .= '<th>Vos pizzas sélectionnées</th>';
	$commande .= '<th></th>';
	$commande .= '<th  width="70">Prix (en €)  </th>';
	$commande .= '<th>Quantité</th>';
	$commande .= '<th>Supprimer</th>';
	$commande .= '</tr>';

	$total = 0;
	
	foreach ($_SESSION['panier'] AS $listeProduit)
	{
	    if (!empty($listeProduit))
	    {
		$commande .= '<tr >';
		$commande .='<td class="listePizza">' . $listeProduit['libelle_produit'] . '</td>';
		$commande .= '<td></td>';
		$commande .= '<td align="center">' . $listeProduit['prix_produit'] . '</td>';
		$commande .= '<td>' . $listeProduit['quantite_produit'] . '</td>';
		$commande .= '<td>X</td>';
		$commande .= '</tr>';

		$total += floatval($listeProduit['prix_produit']) * floatval($listeProduit['quantite_produit']);
	    }
	}


	$commande .= '<tr>';
	$commande .= '<td>Total</td>';
	$commande .= '<td></td>';
	$commande .= '<td align="center">' . $total . '</td>';
	$commande .= '<td></td>';
	$commande .= '<td></td>';
	$commande .= '</tr>';
	$commande .= '</table>';

	return $commande;
    }

    function ValiderPanier()
    {
	
    }

}

?>
