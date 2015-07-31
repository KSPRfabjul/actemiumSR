<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA CATEGORIE
 */

$id = $_POST['id'];

$req = "SELECT * FROM fichier_technique WHERE id=$id";
$select = $db->query($req);
$fichier = $select->fetch();


echo "
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
            <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" placeholder=\"Nom du fichier\" value=\"" . $fichier['nom'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputNomProduit\" class=\"col-sm-2 control-label\">Nom du produit</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputNomProduit\" name=\"inputNomProduit\" placeholder=\"Nom du produit\" value=\"" . $fichier['nom_produit'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputReference\" class=\"col-sm-2 control-label\">Référence</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputReference\" name=\"inputReference\" placeholder=\"Référence\" value=\"" . $fichier['ref'] ."\">
        </div>
    </div>
    <div class=\"form-group\">
        <label for=\"inputFabricant\" class=\"col-sm-2 control-label\">Fabricant</label>
        <div class=\"col-sm-10\">
            <input type=\"text\" class=\"form-control\" id=\"inputFabricant\" name=\"inputFabricant\" placeholder=\"Fabricant\" value=\"" . $fichier['fabricant'] ."\">
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