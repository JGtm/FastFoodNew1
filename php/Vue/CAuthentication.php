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
class CAuthentication
{ 
  
    private $CHtml;

    function __construct()
    {
       $this->CHtml = new CHtml();
    }

    public function getHtml() {
        
        $array = array
                    (
                    'e-Mail :' => "email",
                    'Mot de Passe :' => "mdp",
                );
        $lien = '';
        
        
        $html = $this->CHtml->genererFormulaire($array, $lien);
        
        if(isset($_GET['error'])) {
            $html .= $this->getError();
        }

      return $html;

    }
    
    private function getError() {
        return "<span class=\"error\">Erreur !</span>";
    }
    
}

?>
