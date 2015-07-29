<?php

include '../../lib/includes.php';

if(isset($_POST['id_categorie'])) {

	if(isset($_POST['id_fichier'])){
	
		echo "<option value='1'>TEST</option>"; 
		
	} else{
		$id = $db->quote($_POST['id_categorie']);
		
	    $requete = $db->query("SELECT id, nom FROM sscat WHERE id_cat =$id ORDER BY id");
	    $sous_categories = $requete->fetchAll();
	
	    echo "<select name='inputSousCategorie'>";
	    	echo "<option value =''>Sous-catégorie</option>";
		foreach($sous_categories as $sous_categorie):
			echo "<option value='".$sous_categorie["id"]."'>".$sous_categorie["nom"]."</option>";
		endforeach;
		echo "</select>";	
	}
    
}

?>