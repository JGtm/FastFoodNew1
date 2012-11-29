<?php
require_once 'php/Modele/CModeleCommande.php';
class CVueCommander

{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	//$html = $this->affichageCommande();
        $html.= $this->affichageCommande();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }
    
    function affichageCommande()
    {
        $commande='';
        //var_dump($_SESSION['commande']);

        $objectCommande=unserialize($_SESSION['commande']);
        $produitCmd=$objectCommande->getLesComprendres();
        
        
        $commande.='<table>';
        $commande.='<thead>';
        $commande.='<tr>';
        $commande.='<th>';
        $commande.='<label>id_produit</label>';
        $commande.='</th>';
        $commande.='<th>';
        $commande.='<label>quantite</label>';
        $commande.='</th>';
        $commande.='</tr>';
        $commande.='</thead>';
        $commande.='<tbody>';
        foreach ($produitCmd AS $values)
	{
	
        $commande.='<tr>';
        $commande.='<td>';
        $commande.='<label>';
        $commande.= $values->getId_produit();
        $commande.='</label>';
        $commande.='</td>';
        $commande.='<td>';
        $commande.='<label>';
        $commande.= $values->getQuantite();
        $commande.='</label>';
        $commande.='</td>';
        $commande.='</tr>';
	}
        $commande.='</tbody>';
        $commande.='</table>';
        
        
        return $commande;
    }

    function ValiderPanier()
    {



	return print_r($_POST);
    }

}

?>
