<?php
	
include '../../lib/errors.php';

include '../../lib/includes.php';


/**
* SELECTION DE TOUTES LES VISITES
**/
$select = $db->query("SELECT V.id, DATE_FORMAT(date, '%d-%m-%Y') AS date, personnes, societe, raison, viennoiserie, restaurant, nb_personne, UPPER(nom) AS nom, prenom FROM visite_future V, salarie S WHERE V.id_createur = S.id ORDER BY V.id DESC");
$visites_futures = $select->fetchAll();


if(isset($_POST['hidden'])){
	
	/**
	 * MODIFICATION DANS LA BASE
	 */
	if($_POST['hidden'] == 'update'){
	
	    $date = $db->quote($_POST['date']);
	    $personne = $db->quote($_POST['inputPersonnes']);
	    $societe = $db->quote($_POST['inputSociete']);
	    $raison = $db->quote($_POST['inputRaison']);
	    if(!isset($_POST['inputViennoiserie'])){
	        $viennoiserie=$db->quote('0');
	    } else {
	        $viennoiserie=$db->quote('1');
	    }
	    if(!isset($_POST['inputRestaurant'])){
	        $restaurant=$db->quote('0');
	    } else {
	        $restaurant=$db->quote('1');
	    }
	    $nb_personne = $db->quote($_POST['inputNbPersonne']);
	    $id = $db->quote($_POST['inputId']);
	
	    $db->query("UPDATE visite_future SET date=$date, personnes=$personne, societe=$societe, raison=$raison, viennoiserie=$viennoiserie, restaurant=$restaurant, nb_personne=$nb_personne WHERE id=$id");
	    setFlash('Visite modifiée');
	    header('Location:' . WEBROOT . '/visiteur/programmer_visite.php');
	    die();
	}
	
	
	/**
	 * INSERTION DANS LA BASE D'UNE VISITE
	 */
	if($_POST['hidden'] == 'insert'){
	
	    $date = $db->quote($_POST['date']);
	    $personne = $db->quote($_POST['inputPersonnes']);
	    $societe = $db->quote($_POST['inputSociete']);
	    $raison = $db->quote($_POST['inputRaison']);
	    if(!isset($_POST['inputViennoiserie'])){
	        $viennoiserie=$db->quote('0');
	    } else {
	        $viennoiserie=$db->quote('1');
	    }
	    if(!isset($_POST['inputRestaurant'])){
	        $restaurant=$db->quote('0');
	    } else {
	        $restaurant=$db->quote('1');
	    }
	    $nb_personne = $db->quote($_POST['inputNbPersonne']);
	    $id = $db->quote($_POST['inputId']);
	
	    /*echo "INSERT INTO visite_future SET date=$date, personnes=$personne, societe=$societe, raison=$raison, viennoiserie=$viennoiserie, restaurant=$restaurant, nb_personne=$nb_personne";*/
	    $db->query("INSERT INTO visite_future SET date=$date, personnes=$personne, societe=$societe, raison=$raison, viennoiserie=$viennoiserie, restaurant=$restaurant, nb_personne=$nb_personne, id_createur='".$_SESSION['Auth']['id']."'");
	    setFlash('Visite ajoutée');
	    header('Location:' . WEBROOT . '/visiteur/programmer_visite.php');
	    die();
	}
		
}

/**
 * SUPPRESSION
 */
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    $db->query("DELETE FROM visite_future WHERE id=$id");
    header('Location:./programmer_visite.php');
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
                        Programmer une visite
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Visite
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Programmer une visite
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newVisite">Programmer une visite</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableVisites">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Personnes</th>
                                    <th>Entreprise</th>
                                    <th>Raison visite</th>
                                    <th>Viennoiseries ?</th>
                                    <th>Restaurant ?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($visites_futures as $visite_future): ?>
                                    <tr>
                                        <td><?= $visite_future['id']; ?></td>
                                        <td><?= $visite_future['date']; ?></td>
                                        <td><?= $visite_future['personnes']; ?></td>
                                        <td><?= $visite_future['societe']; ?></td>
                                        <td><?= $visite_future['raison']; ?></td>
                                        <td><?php if($visite_future['viennoiserie'] == 1){ echo "<i class=\"fa fa-check\"></i>";} else { echo "<i class=\"fa fa-ban\"></i>";} ?></td>
                                        <td><?php if($visite_future['restaurant'] == 1){ echo "Pour ".$visite_future['nb_personne']." personnes";} else { echo "<i class=\"fa fa-ban\"></i>";} ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalVisite" id="#LienModalVisite" data-toggle="modal" data-target="#modalModif" rel="<?= $visite_future['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $visite_future['id']; ?>" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
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
                            <h4 class="modal-title">Nouvelle visite</h4>
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
                                    <label for="inputPersonnes" class="col-sm-2 control-label">Personnes</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" id="inputPersonnes" name="inputPersonnes"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSociete" class="col-sm-2 control-label">Société</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSociete" name="inputSociete" placeholder="Société">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRaison" class="col-sm-2 control-label">Raison visite</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" id="inputRaison" name="inputRaison"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="inputViennoiserie" name="inputViennoiserie"> Viennoiseries ?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="inputRestaurant" name="inputRestaurant"> Restaurant ?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNbPersonne" class="col-sm-5 control-label">Nombre de personnes</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control bfh-number" id="inputNbPersonne" name="inputNbPersonne">
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