<?php

/**
* GENERAL INCLUDES
**/
include '../lib/db.php';
include '../partials/header_reservation.php';

/**
* SELECTION DE TOUS LES EMPRUNTS
**/
$select = $db->query("SELECT E.id AS id, S.nom AS nom, S.prenom AS prenom, O.nom AS nom_outil, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM emprunt E, salarie S, outil O WHERE id_outil=O.id AND id_salarie=S.id ORDER BY date DESC");
$emprunts = $select->fetchAll();

/**
* SUPPRESSION
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM emprunt WHERE id=$id");
    header('Location:index.php');
    die();
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
                <h1>Historique réservation</h1>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <form class="form-inline">
                    <a class="btn btn-default btn-primary" href="nouvel_emprunt.php">Nouvel emprunt</a>
                    <a class="btn btn-default btn-primary" href="ajout_equipement.php">Ajouter un équipement</a>
                </form>

                <table class="table table-striped table-hover table-condensed table-outils">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="outils">Outils</th>
                            <th data-field="personne">Personne</th>
                            <th data-field="date">Date</th>
                            <th data-field="supprimer"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($emprunts as $emprunt): ?>
                            <tr>
                                <td><?= $emprunt['id']; ?></td>
                                <td><?= $emprunt['nom_outil']; ?></td>
                                <td><?= $emprunt['prenom'].' '.$emprunt['nom']; ?></td>
                                <td><?= $emprunt['date']; ?></td>
                                <td>
                                    <a href="?delete=<?= $emprunt['id']; ?>" class="btn btn-default btn-sm" onclick="return confirm('Voulez-vous supprimer cet emprunt?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <a class="btn btn-default btn-block btn-primary" href="#">Liste complète des emprunts</a>

            </div>
        </section>


    </div>
</div>

<!-- script references -->
<script src="../js/jquery-2.1.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>