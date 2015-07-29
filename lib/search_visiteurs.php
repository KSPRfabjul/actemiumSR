<?php

include './includes.php';

header('Content-type: application/json');

if($_POST['nom'] == '' && $_POST['entreprise'] == ''){

	/**
	* SELECTION DE TOUTES LES VISITES
	**/
	$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom, entreprise, mail, telephone FROM visiteur V ORDER BY nom ASC");
	$visiteurs = $select->fetchAll();

	$arr = array();

	foreach($visiteurs as $visiteur){
		$arr[] = array ('id' => $visiteur['id'],
						'nom' => $visiteur['nom'],
						'prenom' => $visiteur['prenom'],
						'entreprise' => $visiteur['entreprise'],
						'telephone' => $visiteur['telephone'],
						'mail' => $visiteur['mail']);
	}

	$array = array("visiteurs" => $arr);
	echo json_encode($array);

} else if ($_POST['nom'] != '' && $_POST['entreprise'] == ''){

	$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom, entreprise, mail, telephone FROM visiteur V WHERE nom LIKE '".$_POST['nom']."%' OR prenom LIKE '".$_POST['nom']."%' ORDER BY nom ASC");
	$visiteurs = $select->fetchAll();

	$arr = array();

	foreach($visiteurs as $visiteur){
		$arr[] = array ('id' => $visiteur['id'],
						'nom' => $visiteur['nom'],
						'prenom' => $visiteur['prenom'],
						'entreprise' => $visiteur['entreprise'],
						'telephone' => $visiteur['telephone'],
						'mail' => $visiteur['mail']);
	}

	$array = array("visiteurs" => $arr);
	echo json_encode($array);

} else if ($_POST['nom'] == '' && $_POST['entreprise'] != ''){

	$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom, entreprise, mail, telephone FROM visiteur V WHERE entreprise LIKE '".$_POST['entreprise']."%' ORDER BY nom ASC");
	$visiteurs = $select->fetchAll();

	$arr = array();

	foreach($visiteurs as $visiteur){
		$arr[] = array ('id' => $visiteur['id'],
						'nom' => $visiteur['nom'],
						'prenom' => $visiteur['prenom'],
						'entreprise' => $visiteur['entreprise'],
						'telephone' => $visiteur['telephone'],
						'mail' => $visiteur['mail']);
	}

	$array = array("visiteurs" => $arr);
	echo json_encode($array);

} else {

	$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom, entreprise, mail, telephone FROM visiteur V WHERE (nom LIKE '".$_POST['nom']."%' AND entreprise LIKE '".$_POST['entreprise']."%') OR (prenom LIKE '".$_POST['nom']."%' AND entreprise LIKE '".$_POST['entreprise']."%') ORDER BY nom ASC");
	$visiteurs = $select->fetchAll();

	$arr = array();

	foreach($visiteurs as $visiteur){
		$arr[] = array ('id' => $visiteur['id'],
						'nom' => $visiteur['nom'],
						'prenom' => $visiteur['prenom'],
						'entreprise' => $visiteur['entreprise'],
						'telephone' => $visiteur['telephone'],
						'mail' => $visiteur['mail']);
	}

	$array = array("visiteurs" => $arr);
	echo json_encode($array);

}

?>