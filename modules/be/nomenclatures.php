<?php
include '../../lib/errors.php';
include '../../lib/includes.php';

/**
 * SELECTION DE TOUTES LES AFFAIRES
 */
$select = $db->query("SELECT * FROM affaire ORDER BY numero");
$affaires = $select->fetchALl();

/**
 * SELECTION DE TOUTES LES NOMENCLATURES
 */
$select = $db->query("SELECT N.id AS id, N.nom AS nom, extension, numero, version, DATE_FORMAT(N.date, '%d-%m-%Y') AS date FROM nomenclature N, affaire A WHERE A.id=N.id_affaire");
$nomenclatures = $select->fetchAll();


if(isset($_POST['hidden'])){

	/**
	 * INSERTION DANS LA BASE
	 */
	if($_POST['hidden'] == 'insert'){
	
		$files = $_FILES['files'];
		$fichiers = array();
		
	    $date = $db->quote(date("Y-m-d"));
	    $nom = $db->quote($_POST['inputNom']);
	    $id_affaire = $db->quote($_POST['inputAffaire']);
	    $version = $db->quote($_POST['inputVersion']);
		
		foreach($files['tmp_name'] as $k => $v){
			$fichiers = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
			
			$db->query("INSERT INTO nomenclature SET id_affaire=$id_affaire, version=$version, date=$date");
            $fichier_id = $db->lastInsertId();
            
            $fichier_name = $_POST['inputNom'] . '.' . $extension;
            
            $select = $db->query("SELECT * FROM affaire WHERE id=$id_affaire");
            $numero_affaire = $select->fetch();
            
            move_uploaded_file($fichiers['tmp_name'], SERVER . $numero_affaire['client'] . '/' . $numero_affaire['numero'].'_'.$numero_affaire['nom'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $fichier_name);
            
            $extension = '.' . $extension;
            $extension = $db->quote($extension);
            $db->query("UPDATE nomenclature SET nom=$nom, extension=$extension WHERE id=$fichier_id");
		}
		
		setFlash('Nomenclature ajouté');
	    header('Location:' . WEBROOT . 'modules/be/nomenclatures.php');
	    die();
	}
	
	/**
	 * MODIFICATION DANS LA BASE
	 */
	if($_POST['hidden'] == 'update'){
	
		$files = $_FILES['files'];
		
		$strlen = strlen($files['name'][0]);

		if($strlen == NULL){ // Si il n'y a pas de fichier
		
			$ancienId = $db->quote($_POST['inputId']);

		    $date = $db->quote(date("Y-m-d"));
		    $nom = $db->quote($_POST['inputNom']);
		    $id_affaire = $db->quote($_POST['inputAffaire']);
		    $version = $db->quote($_POST['inputVersion']);
		    
		    $select = $db->query("SELECT A.nom AS nom_affaire, A.numero AS numero_affaire, A.client AS client, N.nom AS nom_nomenclature, extension FROM nomenclature N, affaire A WHERE N.id_affaire=A.id AND N.id=$ancienId");
		    $ancien_fichier = $select->fetch();
		    
		    $db->query("UPDATE nomenclature SET id_affaire=$id_affaire, version=$version, date=$date WHERE id=$ancienId");
		    
		    $select = $db->query("SELECT * FROM affaire WHERE id=$id_affaire");
            $numero_affaire = $select->fetch();
            
            $fichier_name = $_POST['inputNom'] . $ancien_fichier['extension'];
						
			rename(SERVER . $ancien_fichier['client'] . '/' . $ancien_fichier['numero_affaire'] . '_' . $ancien_fichier['nom_affaire'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $ancien_fichier['nom_nomenclature'] . $ancien_fichier['extension'], SERVER . $numero_affaire['client'] . '/' . $numero_affaire['numero'].'_'.$numero_affaire['nom'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $fichier_name);
					    
		    $db->query("UPDATE nomenclature SET nom=$nom WHERE id=$ancienId");
		    
		    setFlash('Nomenclature modifié');
		    header('Location:' . WEBROOT . '/modules/be/nomenclatures.php');
		    die();
		    
		} else {
			
			$fichiers = array();
						
			$ancienId = $db->quote($_POST['inputId']);
			
		    $date = $db->quote(date("Y-m-d"));
		    $nom = $db->quote($_POST['inputNom']);
		    $id_affaire = $db->quote($_POST['inputAffaire']);
		    $version = $db->quote($_POST['inputVersion']);
		    
		    // Selection du fichier associé
		    $select = $db->query("SELECT A.nom AS nom_affaire, A.numero AS numero_affaire, A.client AS client, N.nom AS nom_nomenclature, extension FROM nomenclature N, affaire A WHERE N.id_affaire=A.id AND N.id=$ancienId");
		    $ancien_fichier = $select->fetch();
		    
		    // Suppression de l'ancien fichier
		    unlink(SERVER . $ancien_fichier['client'] . '/' . $ancien_fichier['numero_affaire'] . '_' . $ancien_fichier['nom_affaire'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $ancien_fichier['nom_nomenclature'] . $ancien_fichier['extension']);
		    $db->query("DELETE FROM nomenclature WHERE id=$ancienId");
			
			foreach($files['tmp_name'] as $k => $v){
				$fichiers = array(
					'name' => $files['name'][$k],
					'tmp_name' => $files['tmp_name'][$k]
				);
				$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
				
				$db->query("INSERT INTO nomenclature SET id_affaire=$id_affaire, version=$version, date=$date");
	            $fichier_id = $db->lastInsertId();
	            
	            $fichier_name = $_POST['inputNom'] . '.' . $extension;
	            
	            $select = $db->query("SELECT * FROM affaire WHERE id=$id_affaire");
	            $numero_affaire = $select->fetch();
	            
	            move_uploaded_file($fichiers['tmp_name'], SERVER . $numero_affaire['client'] . '/' . $numero_affaire['numero'].'_'.$numero_affaire['nom'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $fichier_name);
	            
	            $extension = '.' . $extension;
	            $extension = $db->quote($extension);
	            $db->query("UPDATE nomenclature SET nom=$nom, extension=$extension WHERE id=$fichier_id");
			}
			
			setFlash('Nomenclature ajouté');
		    header('Location:' . WEBROOT . 'modules/be/nomenclatures.php');
		    die();
		    
		}
		
	}
}

/**
 * TELECHARGEMENT DU DOCUMENT
 */
if(isset($_GET['download'])){

	$id = $db->quote($_GET['download']);
	
    $select = $db->query("SELECT * FROM nomenclature WHERE id=$id");
	$fichiers = $select->fetch();
	
	$id_affaire = $db->quote($fichiers['id_affaire']);
	$select = $db->query("SELECT * FROM affaire WHERE id=$id_affaire");
	$affaire = $select->fetch();
	
	$fichier_name = $fichiers['nom'].$fichiers['extension'];
	$file = SERVER . $affaire['client'] . '/' . $affaire['numero'].'_'.$affaire['nom'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $fichier_name;
	
	var_dump($file);
	
	if(file_exists($file)){
		
		header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($file));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    ob_clean();
	    flush();
	    readfile($file);
	    exit;
		
	}
}


/**
* SUPPRESSION DOCUMENT
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    
    $select = $db->query("SELECT * FROM nomenclature WHERE id=$id");
	$fichiers = $select->fetch();
	
	$id_affaire = $db->quote($fichiers['id_affaire']);
	$select = $db->query("SELECT * FROM affaire WHERE id=$id_affaire");
	$affaire = $select->fetch();
	
	$fichier_name = $fichiers['nom'].$fichiers['extension'];
	$res = unlink(SERVER . $affaire['client'] . '/' . $affaire['numero'].'_'.$affaire['nom'] . '/2_ELECTROTECHNIQUE/4_NOMENCLATURES/' . $fichier_name);
	
    $db->query("DELETE FROM nomenclature WHERE id=$id");
    header('Location:./nomenclatures.php');
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
                    <h1 class="page-header">
                        Nomenclatures
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Bureau d'études
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Nomenclatures
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
			<form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newNomen">Nouvelle nomenclature</button>
                    </div>
                </div>
            </form>
            
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableVisiteurs">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Affaire</th>
                                    <th>Date mise à jour</th>
                                    <th>Version</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($nomenclatures as $nomenclature): ?>
                                    <tr>
                                        <td><?= $nomenclature['id']; ?></td>
                                        <td><?= $nomenclature['numero'] . '_' . $nomenclature['nom']; ?></td>
                                        <td><?= $nomenclature['date']; ?></td>
                                        <td><?= $nomenclature['version']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienNomenclature" id="LienNomenclature" data-toggle="modal" data-target="#modalModif" rel="<?= $nomenclature['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $nomenclature['id']; ?>" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                            <a href="?download=<?= $nomenclature['id']; ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
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
            <div class="modal fade" id="newNomen" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouvelle nomenclature</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputFichier" class="col-sm-2 control-label">Nomenclature</label>
			                        <div class="col-sm-10">
			                            <input type="file" name="files[]">
			                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom du fichier">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAffaire" class="col-sm-2 control-label">Affaire</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="inputAffaire" id="inputAffaire">
                                            <option value=""></option>
                                            <?php foreach($affaires as $affaire): ?>
                                                <option value="<?= $affaire['id']; ?>"><?= $affaire['numero'] . '_' . $affaire['nom']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputVersion" class="col-sm-2 control-label">Version</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputVersion" name="inputVersion" placeholder="Version">
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
                            <h4 class="modal-title">Modifier nomenclature</h4>
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

include '../../partials/footer_index.php'

?>