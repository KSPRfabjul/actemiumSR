<?php

include '../../lib/includes.php';

header('Content-type: application/json');

if($_POST['tri_categorie'] == '') {

	$req = "SELECT F.id AS id, F.nom AS nom, F.extension AS extension, C.nom AS nom_categorie, S.nom AS nom_sous_categorie, DATE_FORMAT(date, '%d-%m-%Y') AS date, version FROM fichier_matrice F, categorie C, sscat S WHERE F.id_cat=C.id AND F.id_sscat=S.id";
	$select = $db->query($req);
	$fichiers = $select->fetchAll();
	
	$arr = array();

	foreach($fichiers as $fichier){
		$arr[] = array ('id' => $fichier['id'],
						'nom' => $fichier['nom'],
						'extension' => $fichier['extension'],
						'categorie' => $fichier['nom_categorie'],
						'sous_categorie' => $fichier['nom_sous_categorie'],
						'date' => $fichier['date'],
						'version' => $fichier['version']
					   );
	}


	$array = array("fichiers" => $arr);
	echo json_encode($array);
	
} elseif($_POST['tri_categorie'] != '' && $_POST['tri_sous_categorie'] == '') {
	
	$id_cat = $db->quote($_POST['tri_categorie']);
	
	$req = "SELECT F.id AS id, F.nom AS nom, F.extension AS extension, C.nom AS nom_categorie, S.nom AS nom_sous_categorie, DATE_FORMAT(date, '%d-%m-%Y') AS date, version FROM fichier_matrice F, categorie C, sscat S WHERE F.id_cat=C.id AND F.id_sscat=S.id AND F.id_cat=$id_cat";
	$select = $db->query($req);
	$fichiers = $select->fetchAll();
	
	$arr = array();

	foreach($fichiers as $fichier){
		$arr[] = array ('id' => $fichier['id'],
						'nom' => $fichier['nom'],
						'extension' => $fichier['extension'],
						'categorie' => $fichier['nom_categorie'],
						'sous_categorie' => $fichier['nom_sous_categorie'],
						'date' => $fichier['date'],
						'version' => $fichier['version'],
						'header' => $_POST['tri_categorie']
					   );
	}


	$array = array("fichiers" => $arr);
	echo json_encode($array);
		
} elseif($_POST['tri_sous_categorie'] != '') {
	
	$id_sous_cat = $db->quote($_POST['tri_sous_categorie']);
	
	$req = "SELECT F.id AS id, F.nom AS nom, F.extension AS extension, C.nom AS nom_categorie, S.nom AS nom_sous_categorie, DATE_FORMAT(date, '%d-%m-%Y') AS date, version FROM fichier_matrice F, categorie C, sscat S WHERE F.id_cat=C.id AND F.id_sscat=S.id AND F.id_sscat=$id_sous_cat";
	$select = $db->query($req);
	$fichiers = $select->fetchAll();
	
	$arr = array();

	foreach($fichiers as $fichier){
		$arr[] = array ('id' => $fichier['id'],
						'nom' => $fichier['nom'],
						'extension' => $fichier['extension'],
						'categorie' => $fichier['nom_categorie'],
						'sous_categorie' => $fichier['nom_sous_categorie'],
						'date' => $fichier['date'],
						'version' => $fichier['version'],
						'header' => $_POST['tri_categorie']
					   );
	}


	$array = array("fichiers" => $arr);
	echo json_encode($array);
		
}

?>