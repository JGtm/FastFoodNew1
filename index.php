<?php

session_start(); // initialisation des variables de session, il ne doit pas y avoir d'affichage avant cette ligne!!
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'php/Controleur/CMainController.php';

  $id = $_GET['page'];

  $mainController = new CMainController();
  $mainController->setPage($id);
  $mainController->render();

?>		
