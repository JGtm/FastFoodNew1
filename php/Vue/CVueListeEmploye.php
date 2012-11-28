<?php

require_once 'CHtml.php';

class CVueListeEmploye
{

    function __construct()
    {
        
    }

    public function getHtml()
    {
        $html = $this->genererListeEmploye();

        if (isset($_GET['error']))
        {
            $html .= $this->getError();
        }

        return $html;
    }
        
    public function addEmploye()
    {
        $employe = new CEmploye($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['mdp']);
        return $employe;
    }



    function genererListeEmploye()
    {

        $DB = new CDB();
        $requete = 'SELECT id_utilisateur,nom, prenom, email,mdp FROM Utilisateurs WHERE qualite LIKE "BO"';
        $result = $DB->requete($requete);

        $strListe = '<form method="POST" action="?page=' . $_GET['page'] . '">';
        $strListe .= '<table border=1>';
        $strListe .= '<thead>';
        $strListe .= '<tr>';
        $strListe .= '<td>Nom</td>';
        $strListe .= '<td>Prénom</td>';
        $strListe .= '<td>email</td>';
        $strListe .= '<td>Mot de passe</td>';
        //$strListe .= '<td></td>';
        $strListe .= '</tr>';
        $strListe .= '</thead></tbody>';
        $strListe .= '<tr>';
        $strListe .= '<td><input type="text" name="nom" /></td>';
        $strListe .= '<td><input type="text" name="prenom" /></td>';
        $strListe .= '<td><input type="text" name="email" /></td>';
        $strListe .= '<td><input type="text" name="mdp" /></td>';
        $strListe .= '<td><input type="submit" name="add" value="Ajouter" /></td>';
        $strListe .= '</tr>';

        foreach ($result as $employe)
        {
            $strListe .= '<tr>';
            $strListe .='<td>' . $employe['nom'] . '</td><td>' . $employe['prenom'] . '</td><td>' . $employe['email'] . '</td><td>' . $employe['mdp'] . '</td><td><input type="checkbox" name="selected" value="' . $employe['id_utilisateur'] . '" /></td>';
            $strListe .= '</tr>';
        }

        $strListe .= '</table>';
        $strListe .= '<input type="reset" name="annuler" value="Annuler" />';
        $strListe .= '<input type="submit" name="del" value="Supprimer" />';
        $strListe .= '</form>';

        return $strListe;
    }

}

?>
