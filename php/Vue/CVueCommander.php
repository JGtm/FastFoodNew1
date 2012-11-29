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
	$commande .= '</tr>';

	$total = 0;
	$strListeProduits = '';

	foreach ($_SESSION['panier'] AS $listeProduit)
	{
	    if (!empty($listeProduit))
	    {
		$commande .= '<tr >';
		$commande .='<td class="listePizza">' . $listeProduit['libelle_produit'] . '</td>';
		$strListeProduits .= $listeProduit['libelle_produit'] . ',';
		$commande .= '<td></td>';
		$commande .= '<td align="center">' . $listeProduit['prix_produit'] . '</td>';
		$commande .= '<td>' . $listeProduit['quantite_produit'] . '</td>';
		$commande .= '</tr>';

		$total += floatval($listeProduit['prix_produit']) * floatval($listeProduit['quantite_produit']);
	    }
	}

	$strListeProduits = substr($strListeProduits, 0, -1);

	$commande .= '<tr>';
	$commande .= '<td>Total</td>';
	$commande .= '<td></td>';
	$commande .= '<td align="center">' . $total . '</td>';
	$commande .= '<td></td>';
	$commande .= '</tr>';
	$commande .= '</table>';

	$commande .= '<form method="POST" action="?page=commander&valider=1">';
	$commande .= '<input type="submit" name="valider" value="Valider la commande" />';
	$commande .= '</form>';

	if (isset($_GET['valider']))
	{
	    $DB = new CDB();
	    $DB->insert('Commandes', 'date_debut, date_fin, montant, produits, id_utilisateur', 'NOW(), NOW(), ' . $total . ', "' . $strListeProduits . '", ' . $_SESSION['id_utilisateur']);
	    $last_id = $DB->insert_id_commandes();

	    foreach ($produitCmd AS $values)
	    {
		$DB = new CDB();
		$result = $DB->requete('SELECT libelle_produit, prix_produit FROM produits WHERE id_produit = ' . $values->getId_produit());
		foreach ($result AS $pizza)
		{
		    $DB->insert('Comprendre', 'id_commande, id_produit, quantite', $last_id . ', ' . $values->getId_produit() . ', ' . $values->getQuantite());
		}
	    }

	    return '<p>Commande effectuée!</p>';
	}

	return $commande;
    }

    function ValiderPanier()
    {
	
    }

}

?>
