<?php
	include './includes.php';

	/*echo $_POST['dispo'];*/

	if(isset($_POST['dispo']) && $_POST['dispo'] != ''){

		$dispo = $db->quote($_POST['dispo']);
		$id = $_SESSION['Auth']['id'];

		/**
		* MISE A JOUR DE LA DISPONIBILITE
		**/
		$db->query("UPDATE salarie SET disponibilite=$dispo WHERE id=$id");
		$_SESSION['Auth']['disponibilite'] = $_POST['dispo'];
		echo "success";
	}
?>