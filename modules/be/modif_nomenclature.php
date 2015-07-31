<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA CATEGORIE
 */

$id = $_POST['id'];

$req = "SELECT * FROM nomenclature WHERE id=$id";
$select = $db->query($req);
$fichier = $select->fetch();


/**
 * SELECTION DE TOUTES LES AFFAIRES
 */
$select = $db->query("SELECT * FROM affaire ORDER BY numero");
$affaires = $select->fetchALl();


echo "
<form class=\"form-horizontal\" method=\"POST\" action=\"#\" enctype=\"multipart/form-data\">
    <div class=\"form-group\">
        <label for=\"inputFichier\" class=\"col-sm-2 control-label\">Nomenclature</label>
        <div class=\"col-sm-10\">
            <input type=\"file\" name=\"files[]\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" placeholder=\"Nom du fichier\" value=\"" . $fichier['nom'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputAffaire\" class=\"col-sm-2 control-label\">Affaire</label>
        <div class=\"col-sm-10\">
            <select class=\"form-control\" name=\"inputAffaire\" id=\"inputAffaire\">
                <option value=\"\"></option>";
                foreach($affaires as $affaire):
                    echo "<option value=\"". $affaire['id'] ."\"";
                    if ($affaire['id'] == $fichier['id_affaire']) echo "selected";
                    echo ">" .$affaire['numero'] . '_' . $affaire['nom'] ."</option>";
                endforeach;
            echo "</select>
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputVersion\" class=\"col-sm-2 control-label\">Version</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputVersion\" name=\"inputVersion\" placeholder=\"Version\" value=\"" . $fichier['version'] ."\">
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