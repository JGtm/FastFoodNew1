<?php

require_once 'CHtml.php';

class CLayout
{

    private $CHtml;
    private $content;

    function __construct()
    {
	$this->CHtml = new CHtml();
    }

    public function setContent($content)
    {
	$this->content = $content;
    }

    public function render()
    {
	$html = '<!DOCTYPE html>';
	$html .= '<html>';
	$html .= $this->CHtml->head('Pizza INSTA');
	$html .= $this->CHtml->header($this->getMenuItems($_SESSION['qualite']));
	$html .= $this->CHtml->corps('', $this->content);
	$html .= $this->CHtml->ancre();
	$html .= $this->CHtml->footer($this->getMenuItems($_SESSION['qualite']));
	$html .= '</html>';

	return $html;
    }

    public function getMenuItems($rank = '')
    {
	$tabLiens = '';
	switch ($rank)
	{
	    case 'BO':
		$tabLiens = array(
		    'Accueil' => 'index.php',
		    'Gestion des commandes' => '?page=gestioncommande',
		    'Se deconnecter' => '?action=deconnection&page=' . $_GET['page']
		);
		break;
	    
	    case 'SBO':
		$tabLiens = array(
		    'Accueil' => 'index.php',
		    'Les employes' => '?page=listeEmploye',
		    'Les produits' => '?page=adminProduit',
		    'Les ingredients ' => '?page=adminIngreBase',
		    'Se deconnecter' => '?action=deconnection&page=' . $_GET['page']
		);
		break;
	    
	    case 'FO':
		$tabLiens = array(
		    'Accueil' => 'index.php',
		    'Nos produits' => '?page=listeProduit',
                    'Pizza Perso' => '?page=pizzaPerso',
		    'Ma commande' => '?page=commander',
		    'Contact' => '?page=contact ',
		    'Se deconnecter' => '?action=deconnection&page=' . $_GET['page']
		);
		break;
	    
	    default:
		$tabLiens = array(
		    'Accueil' => 'index.php',
		    'Nos produits' => '?page=listeProduit',
		    'Contact' => ' ?page=contact',
		    'S\'identifier' => '?page=authentification'
		);
		break;
	}

	return $tabLiens;
    }

}

?>
