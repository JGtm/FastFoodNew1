<?php

require_once('php/Vue/CLayout.php');
require_once('php/Modele/CDB.php');
require_once('php/Modele/CEmploye.php');
require_once('php/Modele/CClient.php');
require_once('php/Modele/CAdministrateur.php');

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
            case 'adminIngreBase':
                require_once('php/Vue/CVueIngreBase.php');
                $this->view = new CVueIngreBase();
                  if($_POST['libelle_base']) {
                    $base = $this->view->addBase();
                    $base->create();
                }
                if($_POST['libelle'] && $_POST['prix']) {
                    $ingredient = $this->view->addIngredient();
                    $ingredient->create();
                }
                
                break;
            case 'adminPizza':
                require_once('php/Vue/CPizza.php');
                $this->view = new CPizza();
                
                if($_POST['libelle_produit']) {
                    $pizza = $this->view->addPizza();
                    $pizza->create();
                }
                
                break;
            case 'authentification':
                require_once('php/Vue/CAuthentication.php');
                $this->view = new CAuthentication();
                break;
            case 'inscription':
                require_once('php/Vue/CSubscription.php');
                $this->view = new CSubscription();
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
                    header('Location:index.php?page=authentification&error');
                }
            }
        }
    }

}

?>
