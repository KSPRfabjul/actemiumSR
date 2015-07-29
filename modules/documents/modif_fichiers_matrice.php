<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA CATEGORIE
 */

$id = $_POST['id'];

$req = "SELECT * FROM fichier_matrice WHERE id=$id";
$select = $db->query($req);
$fichier = $select->fetch();


/**
 * SELECTION DES CATEGORIES
 */
$select = $db->query("SELECT * FROM categorie");
$categories = $select->fetchAll();

/**
 * SELECTION DES SOUS-CATEGORIES ASSOCIEES
 */
$id_cat = $db->quote($fichier['id_cat']);
$select = $db->query("SELECT * FROM sscat WHERE id_cat=$id_cat");
$sous_categories = $select->fetchAll();

echo "
<script>

function getXhr(){
	var xhr = null; 
	
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
		try {
			xhr = new ActiveXObject(\"Msxml2.XMLHTTP\");
		} catch (e) {
			xhr = new ActiveXObject(\"Microsoft.XMLHTTP\");
		}
	}
	else { // XMLHttpRequest non supporté par le navigateur 
		alert(\"Votre navigateur ne supporte pas les objets XMLHTTPRequest...\"); 
		xhr = false; 
	} 
	
	return xhr;
}


function go_modal(){
	var xhr = getXhr();
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
	
			document.getElementById('inputSousCategorieModal').innerHTML = leselect;
		}
	}
	
	
	xhr.open(\"POST\",\"load_sous_categories_modal.php\",true);
	
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	sel = document.getElementById('inputCategorieModal');
	idcategorie = sel.options[sel.selectedIndex].value;
	xhr.send(\"id_categorie=\"+idcategorie);
}

</script>

<form class=\"form-horizontal\" method=\"POST\" action=\"#\" enctype=\"multipart/form-data\">
    <div class=\"form-group\">
        <label for=\"inputFichier\" class=\"col-sm-2 control-label\">Fichier</label>
        <div class=\"col-sm-10\">
            <input type=\"file\" name=\"files[]\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" placeholder=\"Nom du document\" value=\"". $fichier['nom'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputCategorie\" class=\"col-sm-2 control-label\">Catégorie</label>
        <div class=\"col-sm-10\">
            <select class=\"form-control\" name=\"inputCategorie\" id=\"inputCategorieModal\" onchange='go_modal()' onload='go_modal()'>
                <option value=\"\"></option>";
                foreach($categories as $categorie):
                    echo "<option value=\"".$categorie['id']."\"";
                    if($categorie['id'] == $fichier['id_cat']) echo "selected";
                    echo ">".$categorie['nom']."</option>";
                endforeach;
            echo "</select>
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputSousCategorie\" class=\"col-sm-2 control-label\">Sous-catégorie</label>
        <div class=\"col-sm-10\">
            <select class=\"form-control\" name=\"inputSousCategorie\" id=\"inputSousCategorieModal\">
                <option value=\"\"></option>";
	            foreach($sous_categories as $sous_categorie):
	                    echo "<option value=\"".$sous_categorie['id']."\"";
	                    if($sous_categorie['id'] == $fichier['id_sscat']) echo "selected";
	                    echo ">".$sous_categorie['nom']."</option>";
	                endforeach;
	        echo "</select>
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputVersion\" class=\"col-sm-2 control-label\">Version</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputVersion\" name=\"inputVersion\" placeholder=\"Version\" value=\"". $fichier['version'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <div class=\"col-sm-offset-2 col-sm-10\">
            <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
        </div>
    </div>
    <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
	<input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"update\">
</form>
	
";

?>