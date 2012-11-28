<?php

class CVueCommander

{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	//$html = $this->affichageCommande();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }
    
    function affichageCommande()
    {
        $commande='';
        
        return $commande;
    }

    function ValiderPanier()
    {

	foreach ($_POST AS $post => $value)
	{
	    
	}

	return print_r($_POST);
    }

}

?>
