<?php

require_once('php/Vue/CLayout.php');
require_once('php/Modele/CDB.php');
require_once('php/Modele/CEmploye.php');
require_once('php/Modele/CClient.php');
require_once('php/Modele/CAdministrateur.php');
require_once('php/Modele/CModelePizza.php');

class CMainController
{

    private $db;
    private $id;
    private $layout;
    private $view;
    private $user;

    function __construct()
    {
        $this->db = new CDB();
        $user = $this->connect();

        if (isset($_GET['action']) && $_GET['action'])
        {
            if ($_GET['action'] === 'deconnection')
            {
                $this->disconnect();
            }
        }

        $this->layout = new CLayout($user);
    }

    public function setPage($id = '', $params = '')
    {
        $this->id = $id;
        //$this->params = $params;
        switch ($this->id)
        {
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
                        $ingredient = $this->view->addIngredient();
                        $ingredient->create();
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

            case 'listePizza':
                require_once('php/Vue/CVueListePizza.php');
                $this->view = new CVueListePizza();

                break;

            case 'contact':
                require_once('php/Vue/CVueContact.php');
                $this->view = new CVueContact();

                break;
            case 'listeEmploye':
                require_once('php/Vue/CVueListeEmploye.php');
                $this->view = new CVueListeEmploye();
                break;
            case 'commander':
                require_once('php/Vue/CVueCommander.php');
                $this->view = new CVueCommander();
                break;

            case 'inscription':
                require_once('php/Vue/CVueInscription.php');
                $this->view = new CVueInscription();
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
        header('Location:' . $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']);
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

                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['adresse'] = $user['adresse'];
                    $_SESSION['code_postal'] = $user['code_postal'];
                    $_SESSION['ville'] = $user['ville'];
                    $_SESSION['telephone'] = $user['telephone'];
                    $_SESSION['qualite'] = $user['qualite'];

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
