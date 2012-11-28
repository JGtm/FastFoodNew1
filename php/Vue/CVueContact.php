
<?php

class CVueContact
{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	$html = $this->genererFomulaireContact();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    function genererFomulaireContact()
    {
	$form = '<h3 class="title">Nous contacter</h3>';
	$form .= '<p>Si vous avez des questions, suggestions ou tout simplement un point de vue à exprimer à propos de ce site, n\'hésitez pas à nous contacter.</p>';

	/*
	 * *******************************************************************************************
	  CONFIGURATION
	 * *******************************************************************************************
	 */
	//destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
	$destinataire = 't.lemporte@insta.fr';

	// copie ? (envoie une copie au visiteur)
	$copie = 'oui';

	// Action du formulaire (si votre page a des paramètres dans l'URL)
	// si cette page est index.php?page=contact alors mettez index.php?page=contact
	// sinon, laissez vide
	$form_action = '?page=contact';

	// Messages de confirmation du mail
	$message_envoye = '<p style="color:orange" id="confirm"> Votre message nous est bien parvenu !</p>';
	$message_non_envoye = '<p style="color:orange" id="confirm"> L\'envoi du mail a échoué, veuillez réessayer SVP.</p>';

	// Message d'erreur du formulaire
	$message_formulaire_invalide = '<p style="color:orange" id="confirm">Vérifiez que tous les champs soient bien remplis et que l\'email soit valide.</p>';

	/*
	 * *******************************************************************************************
	  FIN DE LA CONFIGURATION
	 * *******************************************************************************************
	 */

	$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin
	// si formulaire envoyé, on récupère tous les champs. Sinon, on initialise les variables.
	$nom = (isset($_POST['nom'])) ? $this->Rec($_POST['nom']) : '';
	$prenom = (isset($_POST['prenom'])) ? $this->Rec($_POST['prenom']) : '';
	$email = (isset($_POST['email'])) ? $this->Rec($_POST['email']) : '';
	$sujet = (isset($_POST['objet'])) ? $this->Rec($_POST['objet']) : '';
	$message = $sujet . "\r\n";
	$message .= (isset($_POST['message'])) ? $this->Rec($_POST['message']) : '';

	if (isset($_POST['envoi']))
	{
	    // On va vérifier les variables et l'email ...
	    $email = ($this->IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
	    $err_formulaire = ($this->IsEmail($email)) ? false : true;

	    if (($nom != '') && ($prenom != '') && ($email != '') && ($message != ''))
	    {
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers = 'From: Pizza INSTA <' . $noReply . '>' . "\r\n";
		$objet = 'Nouveau message de ' . ucfirst($nom) . ' ' . ucfirst($prenom) . ' via formulaire de contact sur ';

		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
		    $cible = $destinataire . ',' . $email;
		}
		else
		{
		    $cible = $destinataire;
		}

		// Remplacement de certains caractères spéciaux
		$message = html_entity_decode($message);
		$message = str_replace('&#039;', "'", $message);
		$message = str_replace('&#8217;', "'", $message);
		$message = str_replace('<br>', '', $message);
		$message = str_replace('<br />', '', $message);

		// Envoi du mail
		if (mail($cible, $objet, $message, $headers))
		{
		    $form .= '<p>' . $message_envoye . '</p>' . "\n";
		}
		else
		{
		    $form .= '<p>' . $message_non_envoye . '</p>' . "\n";
		}
	    }
	    else
	    {
		// une des 3 variables (ou plus) est vide ...
		$form .= $message_formulaire_invalide;
		$err_formulaire = true;
	    }
	}

	if (($err_formulaire) || (!isset($_POST['envoi'])))
	{
	    // afficher le formulaire
	    $form .= '<form id="contact" method="post" action="' . $form_action . '#confirm">';
	    $form .= '			<label for="nom"> Nom* :</label><br />';
	    $form .= '			<input type="text" id="nom" name="nom" value="' . stripslashes($nom) . '" tabindex="1"  size="40" /><br />';
	    $form .= '			<br /><label for="prenom"> Prénom* :</label><br />';
	    $form .= '			<input type="text" id="prenom" name="prenom" value="' . stripslashes($prenom) . '" tabindex="1"  size="40" /><br />';
	    $form .= '			<br /><label for="email"> Email* :</label><br />';
	    $form .= '			<input type="text" id="validate" name="email" value="' . stripslashes($email) . '" tabindex="2"  size="40" /><span id="validEmail"></span><br />';
	    $form .= '			<br /><label for="objet"> Objet :</label><br />';
	    $form .= '			<input type="text" id="objet" name="objet" value="' . stripslashes($objet) . '" tabindex="3"  size="40" /><br />';
	    $form .= '			<br /><label for="message"> Message* :</label><br />';
	    $form .= '			<textarea id="message" name="message" tabindex="4" cols="70" rows="10">' . stripslashes($message) . '</textarea><br /><br />';
	    $form .= '&nbsp;&nbsp; <input type="submit" name="envoi" value="Envoyer !" /><br /><br />';
	    $form .= '* Obligatoire</form>';

	    return $form;
	}
    }

    /*
     * cette fonction sert à nettoyer et enregistrer un texte
     */

    function Rec($text)
    {
	$text = trim($text); // delete white spaces after & before text
	if (1 === get_magic_quotes_gpc())
	{
	    $stripslashes = create_function('$txt', 'return stripslashes($txt);');
	}
	else
	{
	    $stripslashes = create_function('$txt', 'return $txt;');
	}

	// magic quotes ?
	$text = stripslashes($text);
	$text = htmlspecialchars($text, ENT_QUOTES); // converts to string with " and ' as well
	$text = nl2br($text);
	
	return $text;
    }

    /*
     * Cette fonction sert à vérifier la syntaxe d'un email
     */

    function IsEmail($email)
    {
	$pattern = "^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,7}$";
	
	return (eregi($pattern, $email)) ? true : false;
    }

}
?>