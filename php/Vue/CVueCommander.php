<?php

class CVueCommander
{

    function __construct()
    {
	
    }

    public function getHtml()
    {
	$html = $this->ValiderPanier();

	if (isset($_GET['error']))
	{
	    $html .= $this->getError();
	}

	return $html;
    }

    function ValiderPanier()
    {
	// Array ( [quantite_22> 1
	//	[quantite_23> 1 
	//	[quantite_24> 1 
	//	[id_pizza_4] => 25 [quantite_25> 1 
	//	[id_pizza_5] => 27 [quantite_27> 1 
	//	[id_pizza_6] => 32 [quantite_32> 1 
	//	[quantite_34> 1
	//	[commander] => Commander ) 
	
	foreach($_POST AS $post => $value)
	{
	    if($value == 'id_pizza')
	}
	
	return print_r($_POST);
    }

}

?>
