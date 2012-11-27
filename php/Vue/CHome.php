<?php

class CHome
{

    private $CHtml;

    function __construct()
    {
	$this->CHtml = new CHtml();
    }

    public function getHtml()
    {

	$html = '<div class="contenu">';
	$html .= '<h2 class="title">Bienvenue chez Pizza INSTA</h3>';
	$html .= '<p>Venez manger nos sublimes pizzas super vénère!</p>';
	$html .= '<img src="images/pizza.jpg" />';
	$html .= '<ul>';
	$html .= '<li>Parce qu\'elles sont super bonnes (plus bonne que la plus bonne de tes copines)</li>';
	$html .= '<li>Elles sont faites avec amour!</li>';
	$html .= '<li>Elles sont pas chères</li>';
	$html .= '<li>Puis voilà</li>';
	$html .= '</ul>';
	$html .= '</div>';
	
	return $html;
    }

}