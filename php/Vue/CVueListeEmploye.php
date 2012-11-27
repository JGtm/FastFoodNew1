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

    function genererListeEmploye()
    {

	$DB = new CDB();
	$result = $DB->requete('SELECT 
				id_utilisateur,
				nom, 
				prenom, 
				email, 
				mdp 
			    FROM 
				Utilisateurs 
			    WHERE 
				qualite LIKE "BO"');
	
	$strListe = '<form method="POST" action="?page='.$_GET['page'].'">';
	$strListe .= '<table>';
        $strListe .= '<thead>';
	$strListe .= '<th>';
	$strListe .= '<td>Nom</td>';
	$strListe .= '<td>Prénom</td>';
	$strListe .= '<td>email</td>';
	$strListe .= '<td>Mot de passe</td>';
	$strListe .= '</th>';
        $strListe .= '</thead></tbody>';

	foreach ($result as $employe)
	{ 
	    $strListe .= '<tr>';
	    $strListe .='<td>' . $employe['nom'] . '</td><td>' . $employe['prenom'] . '</td><td>' . $employe['email'] . '</td><td>' . $employe['mdp '] . '</td><td><input type="checkbox" value="' . $employe['id_utilisateur'] . '" /></td>';
	    $strListe .= '</tr>';
	}

	$strListe .= '</table>';
	$strListe .= '<input type="reset" name="annuler" value="Annuler" />';
	$strListe .= '<input type="submit" name="virer" value="Virer" />';
	$strListe .= '</form>';

	return $strListe;
    }

}

?>
