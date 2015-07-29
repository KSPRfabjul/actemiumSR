<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $_POST['id'];

$req = "SELECT * FROM salarie WHERE id=$id";
$select = $db->query($req);
$salarie = $select->fetch();

/**
* SELECTION DE TOUS LES OUTILS
**/
$select1 = $db->query("SELECT * FROM status ORDER BY status ASC");
$status = $select1->fetchAll();

echo "
    <link href=\"../../css/datepicker.min.css\" rel=\"stylesheet\" />
    <link href=\"../../css/datepicker3.min.css\" rel=\"stylesheet\" />

    <script src=\"../../js/framework/bootstrap.js\"></script>
    <script src=\"../../js/bootstrap-datepicker.min.js\"></script>

    <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
        <div class=\"form-group\">
            <label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"inputNom\" value=\"".$salarie['nom']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputPrenom\" class=\"col-sm-2 control-label\">Prénom</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputPrenom\" name=\"inputPrenom\" value=\"".$salarie['prenom']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputIdentifiant\" class=\"col-sm-2 control-label\">Identifiant</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" name=\"inputIdentifiant\" value=\"".$salarie['identifiant']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputMdp\" class=\"col-sm-2 control-label\">Mot de passe</label>
            <div class=\"col-sm-10\">
                <input type=\"text\" class=\"form-control\" id=\"inputMdp\" name=\"inputMdp\" placeholder=\"Mot de passe\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputMail\" class=\"col-sm-2 control-label\">Mail</label>
            <div class=\"col-sm-10\">
                <input type=\"mail\" class=\"form-control\" id=\"inputMail\" name=\"inputMail\" value=\"".$salarie['mail']."\">
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"inputMail\" class=\"col-sm-2 control-label\">Status</label>
            <div class=\"col-sm-10\">
                <select class=\"form-control\" name=\"status\" id=\"status\""; if($_SESSION['Auth']['id_status'] != 2){ echo " disabled"; } echo ">
                    <option value=\"\"></option>";
                        foreach($status as $status1):
                            echo "<option value=\"".$status1['id']."\""; if($salarie['id_status'] == $status1['id']){ echo "selected";} echo ">".$status1['status']."</option>\"";
                        endforeach;
                echo "</select>
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