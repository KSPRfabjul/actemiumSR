<?php

include './includes.php';

header('Content-type: application/json');

if($_POST['ordre'] == ''){
	$ordre = 'DESC';
} else {
	$ordre = $_POST['ordre'];
}

if($_POST['tri'] == 'date'){

	/**
	* SELECTION DE TOUTES LES VISITES
	**/
	$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY date ".$ordre;
	$select = $db->query($req);
	$visites = $select->fetchAll();

	$arr = array();

	foreach($visites as $visite){
		$arr[] = array ('id' => $visite['id'],
						'date' => $visite['date'],
						'nom' => $visite['nom'],
						'prenom' => $visite['prenom'],
						'entreprise' => $visite['entreprise'],
						'raison' => $visite['raison']);
	}

	$array = array("visites" => $arr);
	echo json_encode($array);

} else if($_POST['tri'] == 'nom'){

	/**
	* SELECTION DE TOUTES LES VISITES
	**/
	$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY nom ".$ordre;
	$select = $db->query($req);
	$visites = $select->fetchAll();

	$arr = array();

	foreach($visites as $visite){
		$arr[] = array ('id' => $visite['id'],
						'date' => $visite['date'],
						'nom' => $visite['nom'],
						'prenom' => $visite['prenom'],
						'entreprise' => $visite['entreprise'],
						'raison' => $visite['raison']);
	}

	$array = array("visites" => $arr);
	echo json_encode($array);

} else if($_POST['tri'] == 'entreprise'){

	$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY entreprise ".$ordre;
	$select = $db->query($req);
	$visites = $select->fetchAll();

	$arr = array();

	foreach($visites as $visite){
		$arr[] = array ('id' => $visite['id'],
						'date' => $visite['date'],
						'nom' => $visite['nom'],
						'prenom' => $visite['prenom'],
						'entreprise' => $visite['entreprise'],
						'raison' => $visite['raison']);
	}

	$array = array("visites" => $arr);
	echo json_encode($array);

} else {	

	$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY id DESC";
	$select = $db->query($req);
	$visites = $select->fetchAll();

	$arr = array();

	foreach($visites as $visite){
		$arr[] = array ('id' => $visite['id'],
						'date' => $visite['date'],
						'nom' => $visite['nom'],
						'prenom' => $visite['prenom'],
						'entreprise' => $visite['entreprise'],
						'raison' => $visite['raison']);
	}

	$array = array("visites" => $arr);
	echo json_encode($array);

}

?>