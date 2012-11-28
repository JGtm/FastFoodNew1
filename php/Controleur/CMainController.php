<?php

require_once('php/Vue/CLayout.php');
require_once('php/Modele/CDB.php');
require_once('php/Modele/CEmploye.php');
require_once('php/Modele/CClient.php');
require_once('php/Modele/CAdministrateur.php');
require_once('php/Modele/CModelePizza.php');
require_once('php/Modele/CModeleCommande.php');
require_once('php/Modele/CModeleComprendre.php');

class CMainController
{

    private $db;
    private $id;
    private $layout;
    private $view;
    private $user;
    private $commmande;

    function __construct()
    {
	$this->db = new CDB();
	$this->user = $this->connect();

	if (isset($_GET['action']) && $_GET['action'])
	{
	    if ($_GET['action'] === 'deconnection')
	    {
		$this->disconnect();
	    }
	}

	$this->layout = new CLayout($this->user);
    }

    public function setPage($id = '', $params = '')
    {
	$this->id = $id;
	//$this->params = $params;
	switch ($this->id)
	{
            
	    case 'listeProduit':
		require_once('php/Vue/CVueListeProduit.php');
		$this->view = new CVueListeProduit();
//                if (isset($_POST["id_produit"]))
		{
                    $commande=new CModeleCommande('','','','','',$_SESSION['id_utilisateur']);
                    $commande->ajoutProduit($_POST['id_produit'], $_POST['quantite']);
                    var_dump($commande);
		}
                
		break;
              
	    case 'adminProduit':
		require_once('php/Vue/CVueProduit.php');
		$this->view = new CVueProduit();
		if (isset($_POST["add"]))
		{
		    if ($_POST['Types_produits'] == 1)
		    {
			$pizza = $this->view->addPizza();
			$pizza->create();
		    }
		    else
		    if ($_POST['Types_produits'] != null)
		    {
			$produit = $this->view->addProduit();
			$produit->create();
		    }
		}
		if (isset($_POST["del"]))
		{
		    
		}
		break;

	    case 'inscription':
		require_once('php/Vue/CVueInscription.php');
		$this->view = new CVueInscription();

		if (($_POST['mdp']) && ($_POST['email']))
		{
		    $user = $this->view->addUser();
		    $user->create();
		}
		break;
		
	    case 'adminIngreBase':
		require_once('php/Vue/CVueIngreBase.php');
		$this->view = new CVueIngreBase();
		if (isset($_POST["add"]))
		{
		    if ($_POST['libelle_base'])
		    {
			$base = $this->view->addBase();
			$base->create();
		    }
		    if ($_POST['libelle'] && $_POST['prix'])
		    {
			$employe = $this->view->addEmploye();
			$employe->create();
		    }
		    if ($_POST['libelle_type_produit'])
		    {
			$type = $this->view->addTypeProduit();
			$type->create();
		    }
		}
		if (isset($_POST["del"]))
		{
		    if ($_POST['Bases'])
		    {
			$base = $this->view->addBase();
			$base->delete();
		    }
		    if ($_POST['Ingredients'])
		    {
			$ingredient = $this->view->addIngredient();
			$ingredient->delete();
		    }
		    if ($_POST['Types_produits'])
		    {
			$type = $this->view->addTypeProduit();
			$type->delete();
		    }
		}
		break;

	    case 'contact':
		require_once('php/Vue/CVueContact.php');
		$this->view = new CVueContact();

		break;
	    case 'listeEmploye':
		require_once('php/Vue/CVueListeEmploye.php');
		$this->view = new CVueListeEmploye();
		if (isset($_POST["add"]))
		{
		    if ($_POST['email'] && $_POST['mdp'])
		    {
			$employe = $this->view->addEmploye();
			$employe->create();
		    }
		}
		if (isset($_POST["del"]))
		{
		    if ($_POST['selected'])
		    {
			CEmploye::delete($_POST['selected']);
		    }
		}

		break;
	    case 'commander':
		require_once('php/Vue/CVueCommander.php');
		$this->view = new CVueCommander();
                if (isset($_SESSION['commande'])) 
                {
                    $this->commande= unserialize($_SESSION['commande']);
                }
                else
                {
                    $this->commande = new CModeleCommande('','','','','',$_SESSION['id_utilisateur']);
                    $_SESSION['commande']= serialize ($this->commande);
                }
                    break;

	    case 'authentification':
		require_once('php/Vue/CAuthentication.php');
		$this->view = new CAuthentication();
		break;
	    case 'home':
	    default:
		require_once('php/Vue/CHome.php');
		$this->view = new CHome();
		break;
	}
    }

    public function render()
    {

	// Get this specific page's HTML
	$content = $this->view->getHtml();
	// Insert it in the layout
	$this->layout->setContent($content);
	// Get the layout's html
	$html = $this->layout->render();

	// Write it on the document
	echo $html;
    }

    private function disconnect()
    {
	setcookie("session", null);
	header('Location:' . $_SERVER['PHP_SELF']); //. '?page=' . $_GET['page']);
	session_destroy();
    }

    private function connect()
    {
	//Connected
	if (isset($_COOKIE['session']) && $_COOKIE['session'])
	{
	    setcookie("session", $_COOKIE['session'], time() + 1800);

	    if ($_COOKIE['session'] === 'BO')
	    {
		$model = new CEmploye();
	    }
	    else if ($_COOKIE['session'] === 'FO')
	    {
		$model = new CClient();
	    }
	    else if ($_COOKIE['session'] === 'SBO')
	    {
		$model = new CAdministrateur();
	    }

	    if ($model)
	    {
		return $model;
	    }
	    else
	    {
		return null;
	    }
	}
	else
	{
	    if (isset($_POST['email']) && $_POST['email'] != '' &&
		    isset($_POST['mdp']) && $_POST['mdp'] != '') // si les emails et mdp envoyés en POST existent et ne sont pas vides
	    {
		$login = mysql_real_escape_string($_POST['email']);
		$mdp = mysql_real_escape_string($_POST['mdp']);
		$user = $this->db->selects(
			'*', 'utilisateurs', 'mdp = "' . $mdp . '" && email = "' . $login . '"'
		);

		if ($user != null)
		{
		    setcookie("session", $user[0]['qualite'], time() + 1800, null, null, false, false);

		    $_SESSION['nom'] = $user[0]['nom'];
		    $_SESSION['prenom'] = $user[0]['prenom'];
		    $_SESSION['id_utilisateur'] = $this->user[0]['id_utilisateur'];
		    $_SESSION['email'] = $user[0]['email'];
		    $_SESSION['adresse'] = $user[0]['adresse'];
		    $_SESSION['code_postal'] = $user[0]['code_postal'];
		    $_SESSION['ville'] = $user[0]['ville'];
		    $_SESSION['telephone'] = $user[0]['telephone'];
		    $_SESSION['qualite'] = $user[0]['qualite'];
                    $_SESSION['id_utilisateur'] = $user[0]['id_utilisateur'];


		    header('Location:' . $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']);
 
		}
		else
		{
//                    header('Location:index.php?page=authentification&error');
		}
	    }
	}
    }

}

?>
