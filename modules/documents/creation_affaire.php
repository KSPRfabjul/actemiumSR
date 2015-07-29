<?php

include '../../lib/errors.php';

include '../../lib/includes.php';


/**
* SELECTION DE TOUTES LES AFFAIRES
**/
$select = $db->query("SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, A.id, numero, A.nom, client, UPPER(S.nom) AS nom_chef, S.prenom AS prenom_chef, UPPER(S1.nom) as nom_createur, S1.prenom AS prenom_createur FROM affaire A, salarie S, salarie S1 WHERE S.id = A.chef_projet AND S1.identifiant = A.createur ORDER BY A.id DESC");
$affaires = $select->fetchAll();


/**
* SELECTION DE TOUS LES SALARIES
**/
$select = $db->query("SELECT id, UPPER(nom) AS nom, prenom FROM salarie ORDER BY id DESC");
$salaries = $select->fetchAll();



if(isset($_POST['hidden'])){

	/**
	 * MODIFICATION DANS LA BASE
	 */
	if($_POST['hidden'] == 'update'){
	
	    $id = $db->quote($_POST['inputId']);
	    
		$req = "SELECT * FROM affaire WHERE id=$id";
		$select = $db->query($req);
		$affaire = $select->fetch();
	
	    $numero = $db->quote($_POST['inputNumero']);
	    $nom = $db->quote($_POST['inputNom']);
	    $chef_projet = $db->quote($_POST['salarie']);
	    $createur = $db->quote($_SESSION['Auth']['identifiant']);
	    
	    rename(SERVER. $affaire['client'] . '/' .$affaire['numero'] . '_' . $affaire['nom'], SERVER. $affaire['client'] . '/' . $_POST['inputNumero'] . '_' . $_POST['inputNom']);
	
	    $db->query("UPDATE affaire SET numero=$numero, nom=$nom, chef_projet=$chef_projet WHERE id=$id");
	    setFlash('Affaire modifiée');
	    header('Location:' . WEBROOT . '/modules/documents/creation_affaire.php');
	    die();
	}

	/**
	 * INSERTION DANS LA BASE
	 */
	if($_POST['hidden'] == 'insert'){
	
	    $date = $db->quote(date("Y-m-d"));
	    $numero = $db->quote($_POST['inputNumero']);
	    $nom = $db->quote($_POST['inputNom']);
	    $client = $db->quote($_POST['inputClient']);
	    $chef_projet = $db->quote($_POST['salarie']);
	    $createur = $db->quote($_SESSION['Auth']['identifiant']);
	    
/*
	    print_r("INSERT INTO affaire SET date=$date, numero=$numero, nom=$nom, client=$client, chef_projet=$chef_projet, createur=$createur");
	    die();
*/
		umask(0000);
	    mkdir(SERVER. $_POST['inputClient'], 0777);
	    mkdir(SERVER. $_POST['inputClient'] . '/' .$_POST['inputNumero'] . '_' . $_POST['inputNom'], 0777);
	    $dest = SERVER. $_POST['inputClient'] . '/' .$_POST['inputNumero'] . '_' . $_POST['inputNom'];
	    smartCopy(SERVER_SRC, $dest);
	    
	    $db->query("INSERT INTO affaire SET date=$date, numero=$numero, nom=$nom, client=$client, chef_projet=$chef_projet, createur=$createur");
	    
	    setFlash('Affaire créée');
	    header('Location:' . WEBROOT . 'modules/documents/creation_affaire.php');
	    die();
	}

}

/**
* SUPPRESSION AFFAIRE
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    
    $select = $db->query("SELECT * FROM affaire WHERE id=$id");
	$folders = $select->fetchAll();
	
	foreach($folders as $folder):
		rmRecursive(SERVER . $folder['client'] . '/' .$folder['numero'] . '_' . $folder['nom']);
	endforeach;
    
    $db->query("DELETE FROM affaire WHERE id=$id");
    header('Location:./creation_affaire.php');
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
                        Création d'affaire
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Gestion documentaire
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Création d'affaire
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAffaire">Nouvelle affaire</button>
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
                                    <th>Numéro</th>
                                    <th>Client</th>
                                    <th>Nom d'affaire</th>
                                    <th>Chef de projet</th>
                                    <th>Créateur</th>
                                    <th>Date création</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach($affaires as $affaire): ?>
                                    <tr>
                                        <td><?= $affaire['id']; ?></td>
                                        <td><?= $affaire['numero']; ?></td>
                                        <td><?= $affaire['nom']; ?></td>
                                        <td><?= $affaire['client']; ?></td>
                                        <td><?= $affaire['prenom_chef'].' '.$affaire['nom_chef']; ?></td>
                                        <td><?= $affaire['prenom_createur'].' '.$affaire['nom_createur']; ?></td>
                                        <td><?= $affaire['date']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalAffaire" id="#LienModalAffaire" data-toggle="modal" data-target="#modalModif" rel="<?= $affaire['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $affaire['id']; ?>" class="btn btn-default" onclick="return confirm('Cette action supprimera le dossier, continuer?');">Supprimer</a>
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
            <div class="modal fade" id="newAffaire" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouvelle affaire</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="affaireForm" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputNumero" class="col-sm-2 control-label">Numéro</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNumero" name="inputNumero" placeholder="Numéro de l'affaire">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom de l'affaire">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputClient" class="col-sm-2 control-label">Client</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputClient" name="inputClient" placeholder="Client de l'affaire">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMail" class="col-sm-2 control-label">Chef de projet</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="salarie" id="salarie">
                                            <option value=""></option>
                                            <?php foreach($salaries as $salarie): ?>
		                                        <option value="<?= $salarie['id']; ?>"><?= $salarie['prenom'].' '.$salarie['nom']; ?></option>
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
            
            <div class="modal fade" id="modalModif" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modifier affaire</h4>
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
            <!-- /modal -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../lib/debug.php';

include '../../partials/footer_index.php';

?>