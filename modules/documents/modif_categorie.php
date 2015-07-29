<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA CATEGORIE
 */

$id = $_POST['id'];

$req = "SELECT * FROM categorie WHERE id=$id";
$select = $db->query($req);
$categorie = $select->fetch();

echo "
<form class=\"form-horizontal\" method=\"POST\" action=\"#\">
    <div class=\"form-group\">
        <label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" placeholder=\"Nom de la catégorie\" value=\"".$categorie['nom']."\">
        </div>
    </div>
    <div class=\"form-group\">
        <div class=\"col-sm-offset-2 col-sm-10\">
            <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
        </div>
    </div>
    <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
	<input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"updateCategorie\">
</form>
	
";

?>