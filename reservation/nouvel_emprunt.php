<?php

/**
* GENERAL INCLUDES
**/
include '../lib/db.php';
include '../partials/header_reservation.php';


/**
* SELECTION DE TOUS LES EQUIPEMENTS
**/
$select = $db->query("SELECT * FROM outil ORDER BY nom ASC");
$emprunts = $select->fetchAll();

/**
* AJOUT DE L'EMPRUNT DANS LA BASE DE DONNEES
**/
if(isset($_POST['identifiant'])){

    $date = date("Y-m-d");
    $date = $db->quote($date);

    if($_POST['date'] == ''){
        $date = date("Y-m-d");
        $date = $db->quote($date);
    }
    else{
        $date = $db->quote($_POST['date']);
    }

    $identifiant = $db->quote($_POST['identifiant']);
    $equipement = $db->quote($_POST['equipement']);

    $ident = $db->query("SELECT * FROM salarie WHERE identifiant=$identifiant");
    if($ident->rowCount() == 0){
        echo "<div class='alert alert-danger'>Identifiant inconnu</div>";
    } else {
        $pseudo = $ident->fetch();
        $sal = $pseudo['id'];
        $db->query("INSERT INTO emprunt SET date=$date, id_outil=$equipement, id_salarie=$sal");
        echo "<div class='alert alert-success'>Enregistrement effectué</div>";
        header("refresh:3; url=./index.php");
    }
}

?>

<div class="container">
    <div class="row">

        <div class="row">
            <div class="col-lg-5">
                <img src="../img/logo.jpg" class="img-responsive" alt="logo">
            </div>
        </div>

        <section>
            <div class="page-header">
                <h1>Nouvel emprunt</h1>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <a class="btn btn-default btn-default" href="./index.php">Retour</a>
                <form id="formEmprunt" method="post" action="#" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Date</label>
                            <div class="col-lg-5">
                                <div class="input-group input-append date" id="datePicker">
                                    <input type="text" class="form-control" name="date" id="date"/>
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Equipement</label>
                            <div class="col-lg-5">
                                <select class="form-control" name="equipement" id="equipement">
                                    <option value=""></option>
                                    <?php foreach($emprunts as $emprunt): ?>
                                        <option value="<?= $emprunt['id']; ?>"><?= $emprunt['nom']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Identifiant</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Identifiant"/>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>


    </div>
</div>

<!-- script references -->
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#formEmprunt').formValidation({
        message: 'Cette valeur est invalide',
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            identifiant: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            equipement: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez choisir un élément'
                    }
                }
            }
        }
    });

    $('#datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
        });
});
</script>

</body>
</html>