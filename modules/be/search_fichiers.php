<?php

include '../../lib/includes.php';

header('Content-type: application/json');

/*
$jsontest = array(
    'chaine'    => strtoupper($chaine),
    'date'      => date('d/m/Y H:i:s'),
    'phpversion'=> phpversion()
);
*/


if(isset($_POST['nom']) || isset($_POST['ref']) || isset($_POST['fabricant'])){

	$nom = $_POST['nom'];
	$ref = $_POST['ref'];
	$fab = $_POST['fabricant'];

	$select = $db->query("SELECT id, nom, extension, nom_produit, ref, fabricant, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM fichier_technique WHERE nom_produit LIKE '". $nom ."%' AND ref LIKE '". $ref ."%' AND fabricant LIKE '". $fab ."%'");
	$fichiers = $select->fetchAll();

	$arr = array();
	
	foreach($fichiers as $fichier){
		$arr[] = array ( 'id' => $fichier['id'],
						 'nom' => $fichier['nom'],
						 'extension' => $fichier['extension'],
						 'nom_produit' => $fichier['nom_produit'],
						 'ref' => $fichier['ref'],
						 'fabricant' => $fichier['fabricant'],
						 'date' => $fichier['date']);
	}
	
	$array = array("fichiers" => $arr);
	echo json_encode($array);
	
/* 	echo json_encode($jsontest); */
		
}


?>