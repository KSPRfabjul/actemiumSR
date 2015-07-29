<?php

/**
* GENERAL INCLUDES
**/
include '../lib/db.php';

/**
* SELECTION DE TOUS LES OUTILS
**/
$select = $db->query("SELECT * FROM outil ORDER BY nom ASC");
$outils = $select->fetchAll();

/**
* AJOUT DE L'EQUIPEMENT DANS LA BASE DE DONNEES
**/
if(isset($_POST['nom'])){

    $nom = $db->quote($_POST['nom']);

    $select = $db->query("SELECT * FROM outil WHERE nom=$nom");
    if($select->rowCount() == 0){
        $db->query("INSERT INTO outil SET nom=$nom");
        echo "<div class='alert alert-success'>Enregistrement effectué</div>";
        header("refresh:3; url=./index.php");
    } else { 
        echo "<div class='alert alert-danger'>Elément déjà existant</div>";
    }
}

/**
* SUPPRESSION
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM outil WHERE id=$id");
    header('Location:ajout_equipement.php');
    die();
}


include '../partials/header_reservation.php';
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
                <h1>Nouvel équipement</h1>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <a class="btn btn-default btn-default" href="./index.php">Retour</a>
                <form id="formEquipement" method="post" action="#" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nom de l'équipement</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'équipement"/>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th data-field="outils">Outils</th>
                            <th data-field="supprimer"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($outils as $outil): ?>
                            <tr>
                                <td><?= $outil['nom']; ?></td>
                                <td>
                                    <a href="?delete=<?= $outil['id']; ?>" class="btn btn-default btn-sm" onclick="return confirm('Voulez-vous supprimer cet outil?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </section>


    </div>
</div>

<!-- script references -->
<script src="../js/jquery-2.1.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#formEquipement').formValidation({
        message: 'Cette valeur est invalide',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nom: {
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

</body>
</html>