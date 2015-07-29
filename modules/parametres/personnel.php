<?php

include '../../lib/includes.php';


/**
* SELECTION DE TOUS LES SALARIES
**/
$select = $db->query("SELECT * FROM salarie ORDER BY nom ASC");
$salaries = $select->fetchAll();

/**
* SELECTION DE TOUS LES OUTILS
**/
$select1 = $db->query("SELECT * FROM status ORDER BY status ASC");
$status = $select1->fetchAll();

/**
 * MODIFICATION DANS LA BASE
 */
if($_POST['hidden'] == 'update'){

    $nom = $db->quote($_POST['inputNom']);
    $prenom = $db->quote($_POST['inputPrenom']);
    $identifiant = $db->quote($_POST['inputIdentifiant']);
    $mail = $db->quote($_POST['inputMail']);
    $id = $db->quote($_POST['inputId']);
    $stat = $db->quote($_POST['status']);

    if($_POST['inputMdp'] == ''){
        $db->query("UPDATE salarie SET nom=$nom, prenom=$prenom, identifiant=$identifiant, mail=$mail, id_status=$stat WHERE id=$id");
        setFlash('Compte salarié modifié');
        header('Location:' . WEBROOT . 'modules/parametres/personnel.php');
        die();

    } else {
        $mdp = $db->quote(sha1($_POST['inputMdp']));
        $db->query("UPDATE salarie SET nom=$nom, prenom=$prenom, identifiant=$identifiant, mdp=$mdp, mail=$mail, id_status=$stat WHERE id=$id");
        setFlash('Compte salarié modifié');
        header('Location:' . WEBROOT . 'modules/parametres//personnel.php');
        die();
    }
}


/**
 * INSERTION DANS LA BASE D'UNE VISITE
 */
if($_POST['hidden'] == 'insert'){

    $nom = $db->quote($_POST['inputNom']);
    $prenom = $db->quote($_POST['inputPrenom']);
    $identifiant = $db->quote($_POST['inputIdentifiant']);
    $mdp = $db->quote(sha1($_POST['inputMdp']));
    $mail = $db->quote($_POST['inputMail']);
    $stat = $db->quote($_POST['status']);

    $db->query("INSERT INTO salarie SET nom=$nom, prenom=$prenom, identifiant=$identifiant, mdp=$mdp, mail=$mail, id_status=$stat");
    setFlash('Salarié ajouté');
    header('Location:' . WEBROOT . 'modules/parametres//personnel.php');
    die();
}

/**
 * SUPPRESSION
 */
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM salarie WHERE id=$id");
    header('Location:./personnel.php');
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
                        Gestion des comptes salariés
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Gestion interne
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Comptes salariés
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary <?php if($_SESSION['Auth']['id_status'] != '2'){ echo "disabled"; } ?>" data-toggle="modal" data-target="#newVisite">Ajouter un nouveau salarié</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableVisites">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Identifiant</th>
                                    <th>Mail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($salaries as $salarie): ?>
                                    <tr>
                                        <td><?= $salarie['nom'] . ' ' . $salarie['prenom']; ?></td>
                                        <td><?= $salarie['identifiant']; ?></td>
                                        <td><?= $salarie['mail']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalNews <?php if($_SESSION['Auth']['id_status'] != '2' && $_SESSION['Auth']['id'] != $salarie['id']){ echo "disabled"; }?>" id="#LienModalSalarie" data-toggle="modal" data-target="#modalModif" rel="<?= $salarie['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $salarie['id']; ?>" class="btn btn-default <?php if($_SESSION['Auth']['id_status'] != '2' && $_SESSION['Auth']['id'] != $salarie['id']){ echo "disabled"; }?>" onclick="return confirm('Voulez-vous supprimer ce salarie?');">Supprimer</a>
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
                            <h4 class="modal-title">Nouveau compte salarié</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPrenom" class="col-sm-2 control-label">Prénom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" placeholder="Prénom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputIdentifiant" class="col-sm-2 control-label">Identifiant</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputIdentifiant" name="inputIdentifiant" placeholder="Identifiant">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMdp" class="col-sm-2 control-label">Mot de passe</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputMdp" name="inputMdp" placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMail" class="col-sm-2 control-label">Mail</label>
                                    <div class="col-sm-10">
                                        <input type="mail" class="form-control" id="inputMail" name="inputMail" placeholder="Mail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMail" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status" id="status">
                                            <option value=""></option>
                                            <?php foreach($status as $status1): ?>
                                                <option value="<?= $status1['id']; ?>"><?= $status1['status']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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