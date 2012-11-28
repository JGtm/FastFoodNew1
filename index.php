<?php

session_start(); // initialisation des variables de session, il ne doit pas y avoir d'affichage avant cette ligne!!
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
require_once 'php/Controleur/CMainController.php';

  $id = $_GET['page'];

  $mainController = new CMainController();
  $mainController->setPage($id);
  $mainController->render();

?>