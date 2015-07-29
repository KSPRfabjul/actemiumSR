<?php

include '../../lib/includes.php';

if(isset($_POST['id_categorie'])) {
	
		$id_cat = $db->quote($_POST['id_categorie']);
		/* $id_fichier = $db->quote($_POST['id_fichier']); */
		
	    $requete = $db->query("SELECT id, nom FROM sscat WHERE id_cat =$id_cat ORDER BY id");
	    $sous_categories = $requete->fetchAll();

	    echo "<select name='inputSousCategorie'>";
		foreach($sous_categories as $sous_categorie):
			echo "<option value='".$sous_categorie["id"]."'>".$sous_categorie["nom"]."</option>";	
		endforeach;
		echo "</select>";
    
}

?>