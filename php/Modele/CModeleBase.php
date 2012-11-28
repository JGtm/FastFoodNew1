<?php

require_once('php/Modele/CDB.php');

class CModeleBase
{

    private $libelle_base;
    private $DB;

    function __construct($libelle_base)
    {
	$this->libelle_base = $libelle_base;
	$this->DB = new CDB();
    }

    public function create()
    {

	$table = 'Bases';
	$champs = "id_base,libelle_base";
	$value = "'','" . $this->libelle_base . "'";
	$this->DB->insert($table, $champs, $value);
    }

    public function delete()
    {

	$table = 'Bases';
	$condition = 'id_base =' . $_POST['Bases'];
	$this->DB->delete($table, $condition);
    }

}
?>

