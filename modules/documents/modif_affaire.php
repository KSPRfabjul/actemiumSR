<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $_POST['id'];

$req = "SELECT * FROM affaire WHERE id=$id";
$select = $db->query($req);
$affaire = $select->fetch();

/**
 * SELECTION DES SALARIES
 */
$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom FROM salarie ORDER BY id DESC");
$salaries = $select->fetchAll();

echo "
<script src=\"".WEBROOT."/js/formValidation.js\"></script>
<script src=\"".WEBROOT."/js/framework/bootstrap.js\"></script>
<script>
$(document).ready(function() {
    $('#affaireFormUpdate').formValidation({
        framework: 'bootstrap',
        fields: {
            inputNumero: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    },
                    numeric: {
                        message: 'Nombre obligatoire'
                    },
                    stringLength: {
                        min: 5,
                        max: 5,
                        message: 'Le nombre doit contenir 5 chiffres'
                    }
                }
            },
            inputNom: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            salarie: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            }
        }
    });
});
</script>
	<form class=\"form-horizontal\" id=\"affaireFormUpdate\" method=\"POST\" action=\"#\">
        <div class=\"form-group\">
            <label for=\"inputNumero\" class=\"col-sm-2 control-label\">Numéro</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputNumero\" name=\"inputNumero\" placeholder=\"Numéro de l'affaire\" value=\"".$affaire['numero']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" placeholder=\"Nom de l'affaire\" value=\"".$affaire['nom']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputMail\" class=\"col-sm-2 control-label\">Chef de projet</label>
            <div class=\"col-sm-10\">
                <select class=\"form-control\" name=\"salarie\" id=\"salarie\">
                    <option value=\"\"></option>";
                    foreach($salaries as $salarie):
                        echo "<option value=\"".$salarie['id']."\""; if($salarie['id'] == $affaire['chef_projet']){ echo "selected"; } echo ">".$salarie['prenom'].' '.$salarie['nom']."</option>";
                    endforeach;
                echo "</select>
            </div>
        </div>
        <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
        <input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"update\">
	    <div class=\"form-group\">
	        <div class=\"col-sm-offset-2 col-sm-10\">
	            <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
	        </div>
	    </div>
        <div class=\"form-group\">
            <label for=\"inputNom\" class=\"col-sm-10 control-label\">Pour renommer le client, veuillez créer une nouvelle affaire.</label>
        </div>
	</form>
";

?>