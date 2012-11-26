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

  public function render() {
    $html = '<!DOCTYPE html>';
    $html .= '<html>';
    $html .= $this->CHtml->head('salut');
    $html .= $this->CHtml->header($this->getMenuItems($_COOKIE['session']));
    
    $html .= $this->CHtml->corps('', $this->content);
    
    $html .= $this->CHtml->ancre();
    $html .= $this->CHtml->footer($this->getMenuItems($_COOKIE['session']));
    $html .= '</html>';

    return $html;

  }
  
  public function getMenuItems($rank = '') {
    $tabLiens =  '';
    switch ($rank) {
      case 'BO':
        $tabLiens = array(
          'Accueil' => 'index.php',
          'Gestion des commandes' => '?page=gestioncommande',
          'Se deconnecter' =>'?action=deconnection&page='.$_GET['page']
        );
        break;
      case 'SBO':
        $tabLiens = array(
          'Accueil' => 'index.php',
          'Les employes' => '?page=employe',
          'Les produits' => '?page=produit',
          'Les pizza' => '?page=adminPizza',
          'menu' => '?page=listePizza',
          'contact' => ' ',
          'Se deconnecter' =>'?action=deconnection&page='.$_GET['page']
        );
        break;
      case 'FO':
        $tabLiens = array(
          'Accueil' => 'index.php',
          'A propos' => '',
          'menu' => '?page=listePizza',
          'Ma commande' => '?page=commande',
          'contact' => ' ',
          'Se deconnecter' =>'?action=deconnection&page='.$_GET['page']
        );
        break;
      default:
        $tabLiens = array(
          'Accueil' => 'index.php',
          'A propos' => '',
          'menu' => '?page=listePizza',
          'contact' => ' ',
          'S\'identifier' =>'?page=authentification'
        );
        break;
    }

    return $tabLiens;
  }
}

?>