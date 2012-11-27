<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAuthentication
 *
 * @author Nh3
 */
require_once 'CHtml.php';

class CVueInscription
{

    private $CHtml;

    function __construct()
    {
        $this->CHtml = new CHtml();
    }

    public function getHtml()
    {

        $array = array(
            'E-Mail :' => 'email',
            'Mot de passe :' => 'mdp',
            'Nom :' => 'nom',
            'Prenom :' => 'prenom',
            'Adresse:' => 'adresse',
            'Code postal :' => 'code_postal',
            'Ville :' => 'ville',
            'Telephone :' => 'telephone',
        );

        $lien = $_GET['page'];
        $html = $this->CHtml->genererFormulaire($array, $lien);

        if (isset($_GET['error']))
        {
            $html .= $this->getError();
        }

        return $html;
    }

    private function getError()
    {
        return "<span class=\"error\">Erreur !</span>";
    }

    public function addUser()
    {
        $newUser = new CClient($_POST['nom'], $_POST['prenom'], $_POST['email'],
                        $_POST['mdp'], $_POST['adresse'], $_POST['code_postal'],
                        $_POST['ville'], $_POST['telephone']);

        return $newUser;
    }

}

?>
