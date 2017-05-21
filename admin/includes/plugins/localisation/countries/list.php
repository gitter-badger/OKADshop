<?php
$Args = array(
	'Select' => array(
		'ID' => _DB_PREFIX_.'countries.id', 
		'name' => _DB_PREFIX_.'countries.name', 
		'zones'=> _DB_PREFIX_.'zones.name', 
<<<<<<< HEAD
		'langs'=> _DB_PREFIX_.'languages.name', 
=======
		'langs'=> _DB_PREFIX_.'langs.name', 
>>>>>>> 626a5870a752b0b518adbcfa074dbba4e576e490
		'iso_code' => _DB_PREFIX_.'countries.iso_code', 
		'active' => _DB_PREFIX_.'countries.active', 
		'zip_code_format' => 'zip_code_format'
	),
	'From' => array( _DB_PREFIX_.'countries'),
	'Join' => array(
		array( _DB_PREFIX_.'zones', _DB_PREFIX_.'zones.id', _DB_PREFIX_.'countries.id_zone'),
<<<<<<< HEAD
		array( _DB_PREFIX_.'languages', _DB_PREFIX_.'languages.id', _DB_PREFIX_.'countries.id_lang'),
=======
		array( _DB_PREFIX_.'langs', _DB_PREFIX_.'langs.id', _DB_PREFIX_.'countries.id_lang'),
>>>>>>> 626a5870a752b0b518adbcfa074dbba4e576e490
	),
	'Module'=> array('countries','Liste des Pays'),
	'Operations' => array('edit','delete'),
	'THead' => array(
		l("ID", "core"),
		l("Nom de Pays", "core"),
		l("Zone", "core"),
		l("Langue", "core"),
		l("Code ISO", "core"),
		l("Statut", "core"),
		l("Format de CP", "core"),
		l("Operations", "core")
	),
	'Butons' =>	array(
		array( l("Ajouter une Pays", "core"),'?module=countries&action=add','add_nw','add button',l("Ajouter une Pays", "core"),'facebox','iconAdd')
	),
	'UPLOADFIELDS' => array()
	);
$Tables = new Core\Table();
$DATATABLE = $Tables->GET($Args);
?>
	