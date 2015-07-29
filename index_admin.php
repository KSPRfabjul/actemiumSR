<?php

include 'lib/includes.php';

$date = $db->quote(date("Y-m-d"));

/**
 * SELECTION DES NEWS
 */
$select = $db->query("SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS date, message FROM news ORDER BY date ASC");
$news = $select->fetchAll();

/**
* SELECTION DE TOUTES LES VISITES
**/
$select = $db->query("SELECT personnes, societe, raison FROM visite_future WHERE date=$date ORDER BY id ASC");
$visites = $select->fetchAll();

/**
* SELECTION DE TOUTES LES DISPONIBILITES PAR PERSONNE
**/
$select = $db->query("SELECT UPPER(S.nom) as nom, S.prenom as prenom, D.id as id, D.nom as dispo FROM disponibilite D, salarie S WHERE S.disponibilite = D.id ORDER BY S.nom ASC");
$disponibilites = $select->fetchAll();

/**
* SELECTION DE TOUS LES MESSAGES DE LA BOITE A IDEES
**/
$select = $db->query("SELECT id, DATE_FORMAT(date, '%d-%m-%Y') AS date, message FROM boite_idee ORDER BY date ASC");
$boites = $select->fetchAll();

/**
 * INSERER IDEE DANS BOITE A IDEES
 */
if($_POST['hidden'] == 'insert-idee'){

    $message = $db->quote($_POST['inputMessageIdees']);
    $db->query("INSERT INTO boite_idee SET message=$message, date=$date");
    setFlash('Message ajouté');
    header('Location:' . WEBROOT . '/index_admin.php');
    die();
}

/**
 * INSERER IDEE DANS NEWS
 */
if($_POST['hidden'] == 'insert-news'){

    $message = $db->quote($_POST['inputMessageNews']);
    
    $db->query("INSERT INTO news SET message=$message, date=$date");
    setFlash('Message ajouté');
    header('Location:' . WEBROOT . '/index_admin.php');
    die();
}

/**
 * UPDATE NEWS
 */
if($_POST['hidden'] == 'update-news'){
    $message = $db->quote($_POST['inputMessageNews']);
    $id = $db->quote($_POST['inputId']);
    $db->query("UPDATE news SET message=$message WHERE id=$id");
    setFlash('News modifié');
    header('Location:' . WEBROOT . '/index.php');
    die();
}

/**
 * SUPPRESSION
 */
if(isset($_GET['delete_news'])){
    $id = $db->quote($_GET['delete_news']);
    $db->query("DELETE FROM news WHERE id=$id");
    header('Location:./index_admin.php');
}

include 'partials/header_index.php'

?>

<div id="wrapper">

    <?php include './partials/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?= flash(); ?>
                    <h1 class="page-header">
                        Accueil
                        <small>Administrateur</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-home"></i>  <a href="index.html">Accueil</a>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- /.row -->
            <!-- row -->
            <div class="row">
                <div class="col-lg-10">
                    <form class="form-inline bouton-index">
                        <!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newNews">Ajouter news</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newIdee">Boite à idées</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listIdees">Messages dans boite à idées</button>
                        <button type="button" class="btn btn-primary">Mise à jour carte USB</button>
-->
                    </form>
                </div>
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <div class="col-lg-8">
                    <h2>Visites du jour</h2>
                    <div class="table-responsive table-index-info">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Personnes</th>
                                    <th>Société</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($visites as $visite): ?>
                                    <tr>
                                        <td><?= $visite['personnes']; ?></td>
                                        <td><?= $visite['societe']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2>Disponibilités</h2>
                    <div class="table-responsive table-index-info">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Disponibilités</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($disponibilites as $disponibilite): ?>
                                    <tr <?php if($disponibilite['id'] == '1'){ echo "class=\"success\""; } else { echo "class=\"danger\""; }  ?>>
                                        <td><?= $disponibilite['nom']. ' ' .$disponibilite['prenom'] ?></td>
                                        <td><?= $disponibilite['dispo']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /row -->


            <!-- modal -->
            <div class="modal fade" id="newIdee" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouveau message</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputMessageIdees" class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="6" id="inputMessageIdees" name="inputMessageIdees"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden" id="hidden" value="insert-idee">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /modal -->

            <!-- modal -->
            <div class="modal fade" id="newNews" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouvelle news</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputMessageNews" class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="6" id="inputMessageNews" name="inputMessageNews"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden" id="hidden" value="insert-news">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /modal -->

            <!-- modal -->
            <div class="modal fade" id="updateNews" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modifier news</h4>
                        </div>
                        <div class="modal-body modalBodyNews">
                            <!-- Contenu ajouté lors de l'appuie sur le bouton -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /modal -->

            <!-- modal -->
            <div class="modal fade" id="listIdees" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Boite à idées</h4>
                        </div>
                        <div class="modal-body modalBodyNews">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($boites as $boite): ?>
                                        <tr>
                                            <td><?= $boite['date'] ?></td>
                                            <td><?= $boite['message']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /modal -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

/*include 'lib/debug.php';
*/include 'partials/footer_index.php'

?>