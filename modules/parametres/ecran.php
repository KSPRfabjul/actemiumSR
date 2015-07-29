<?php

include '../../lib/includes.php';


/**
* SELECTION DE TOUTES LES VISITES
**/
$select = $db->query("SELECT id, value, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM accueil ORDER BY date ASC");
$messages = $select->fetchAll();

/**
 * MODIFICATION DANS LA BASE
 */
if($_POST['hidden'] == 'update'){

    $date = $db->quote($_POST['date']);
    $value = $db->quote($_POST['inputTexte']);
    $id = $db->quote($_POST['inputId']);

    $db->query("UPDATE accueil SET date=$date, value=$value WHERE id=$id");
    setFlash('Message ecran modifié');
    header('Location:' . WEBROOT . 'modules/parametres/ecran.php');
    die();
}


/**
 * INSERTION DANS LA BASE D'UNE VISITE
 */
if($_POST['hidden'] == 'insert'){

    $date = $db->quote($_POST['date']);
    $value = $db->quote($_POST['inputTexte']);

    $db->query("INSERT INTO accueil SET date=$date, value=$value");
    setFlash('Message ajoutée');
    header('Location:' . WEBROOT . 'modules/parametres/ecran.php');
    die();
}

/**
 * SUPPRESSION
 */
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM accueil WHERE id=$id");
    header('Location:./ecran.php');
}

include '../../partials/header_index.php'

?>

<div id="wrapper">

    <?php include '../../partials/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?= flash(); ?>
                    <h1 class="page-header">
                        Gestion des messages de l'écran d'accueil
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Gestion interne
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Message d'accueil
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newVisite">Ajouter un nouveau message</button>
                        <button type="button" class="btn btn-primary LienModalEcran" id="#LienModalEcran" data-toggle="modal" data-target="#modalModif" rel="1">Modifier le message par défaut</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableVisites">
                            <thead>
                                <tr>
                                    <th data-field="id">Id</th>
                                    <th data-field="texte">Texte affiché</th>
                                    <th data-field="date">Date d'affichage</th>
                                    <th data-field="modifier"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($messages as $message): ?>
                                    <tr>
                                        <td><?= $message['id']; ?></td>
                                        <td><?= $message['value']; ?></td>
                                        <td><?= $message['date']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalEcran" id="#LienModalEcran" data-toggle="modal" data-target="#modalModif" rel="<?= $message['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $message['id']; ?>" class="btn btn-default" onclick="return confirm('Voulez-vous supprimer ce message?');">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- modal -->
            <div class="modal fade" id="newVisite" role="dialog">
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
                                    <label for="datePicker" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-append date" id="datePicker">
                                            <input type="text" class="form-control" name="date" id="date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="datePicker" class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-10">
                                        <textarea name="inputTexte" id="inputTexte"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden" id="hidden" value="insert">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /modal -->

            <div class="modal fade" id="modalModif" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modifier visite</h4>
                        </div>
                        <div class="modal-body modalBody">
                            <!-- Contenu ajouté lors de l'appuie sur le bouton -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../partials/footer_index.php'

?>