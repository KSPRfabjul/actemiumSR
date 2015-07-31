<?php
include '../../lib/errors.php';
include '../../lib/includes.php';


/**
 * SELECTION DE TOUS LES DOCUMENTS
 */
$select = $db->query("SELECT id, nom, extension, nom_produit, ref, fabricant, DATE_FORMAT(date, '%d-%m-%Y') AS date FROM fichier_technique");
$fichiers_technique = $select->fetchAll();



if(isset($_POST['hidden'])){

	/**
	 * INSERTION DANS LA BASE
	 */
	if($_POST['hidden'] == 'insert'){
	
		$files = $_FILES['files'];
		$fichiers = array();
		
	    $date = $db->quote(date("Y-m-d"));
	    $nom = $db->quote($_POST['inputNom']);
	    $nom_produit = $db->quote($_POST['inputNomProduit']);
	    $reference = $db->quote($_POST['inputReference']);
	    $fabricant = $db->quote($_POST['inputFabricant']);
		
		foreach($files['tmp_name'] as $k => $v){
			$fichiers = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
			
			$db->query("INSERT INTO fichier_technique SET nom_produit=$nom_produit, ref=$reference, fabricant=$fabricant, date=$date");
            $fichier_id = $db->lastInsertId();
            
            $fichier_name = $_POST['inputNom'] . '.' . $extension;
            
            umask(0000);
            mkdir(SRC_DOC . '/' . $_POST['inputFabricant']);
            
            move_uploaded_file($fichiers['tmp_name'], SRC_DOC . '/' . $_POST['inputFabricant'] . '/' . $fichier_name);
            
            $extension = '.' . $extension;
            $extension = $db->quote($extension);
            $db->query("UPDATE fichier_technique SET nom=$nom, extension=$extension WHERE id=$fichier_id");
		}
		
		setFlash('Fichier ajouté');
	    header('Location:' . WEBROOT . 'modules/be/liste_doc.php');
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
		    $nom_produit = $db->quote($_POST['inputNomProduit']);
		    $reference = $db->quote($_POST['inputReference']);
		    $fabricant = $db->quote($_POST['inputFabricant']);
		    
		    $select = $db->query("SELECT * FROM fichier_technique WHERE id=$ancienId");
		    $ancien_fichier = $select->fetch();
		    
		    $db->query("UPDATE fichier_technique SET nom_produit=$nom_produit, ref=$reference, fabricant=$fabricant, date=$date WHERE id=$ancienId");
		    
		    if($ancien_fichier['fabricant'] == $_POST['inputFabricant']){
				rename(SRC_DOC . '/' . $ancien_fichier['fabricant'] . '/' . $ancien_fichier['nom'] . $ancien_fichier['extension'], SRC_DOC .  '/' . $_POST['inputFabricant'] . '/' . $_POST['inputNom'] . $ancien_fichier['extension']);
		    } else {
			    umask(0000);
			    mkdir(SRC_DOC . '/' . $_POST['inputFabricant']);
			    
			    $extension = $ancien_fichier['extension'];
			    $fichier_name = $_POST['inputNom'] . $extension;
            
				rename(SRC_DOC . '/' . $ancien_fichier['fabricant'] . '/' . $ancien_fichier['nom'] . $ancien_fichier['extension'], SRC_DOC . '/' . $_POST['inputFabricant'] . '/' . $fichier_name);
		    }
		    
		    $db->query("UPDATE fichier_technique SET nom=$nom WHERE id=$ancienId");
		    
		    setFlash('Fichier modifié');
		    header('Location:' . WEBROOT . '/modules/be/liste_doc.php');
		    die();
		    
		} else {
			
			$fichiers = array();
						
			$ancienId = $db->quote($_POST['inputId']);
			
		    $date = $db->quote(date("Y-m-d"));
		    $nom = $db->quote($_POST['inputNom']);
		    $nom_produit = $db->quote($_POST['inputNomProduit']);
		    $reference = $db->quote($_POST['inputReference']);
		    $fabricant = $db->quote($_POST['inputFabricant']);
		    
		    // Selection du fichier associé
		    $select = $db->query("SELECT * FROM fichier_technique WHERE id=$ancienId");
		    $ancien_fichier = $select->fetch();
		    
		    // Suppression de l'ancien fichier
		    $res = unlink(SRC_DOC . '/' . $ancien_fichier['fabricant'] . '/' . $ancien_fichier['nom'] . $ancien_fichier['extension']);
		    $db->query("DELETE FROM fichier_technique WHERE id=$ancienId");
			
			foreach($files['tmp_name'] as $k => $v){
				$fichiers = array(
					'name' => $files['name'][$k],
					'tmp_name' => $files['tmp_name'][$k]
				);
				
				$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
				$db->query("INSERT INTO fichier_technique SET nom_produit=$nom_produit, ref=$reference, fabricant=$fabricant, date=$date");
	            $fichier_id = $db->lastInsertId();
	            
	            $fichier_name = $_POST['inputNom'] . '.' . $extension;
	            
	            umask(0000);
	            mkdir(SRC_DOC . '/' . $_POST['inputFabricant']);
	            
	            move_uploaded_file($fichiers['tmp_name'], SRC_DOC . '/' . $_POST['inputFabricant'] . '/' . $fichier_name);
	            
	            $extension = '.' . $extension;
	            $extension = $db->quote($extension);
	            $db->query("UPDATE fichier_technique SET nom=$nom, extension=$extension WHERE id=$fichier_id");
            }
		    
		}
		
		setFlash('Fichier modifié');
	    header('Location:' . WEBROOT . 'modules/be/liste_doc.php');
	    die();
		
	}

}

/**
 * TELECHARGEMENT DU DOCUMENT
 */
if(isset($_GET['download'])){

	$id = $db->quote($_GET['download']);
	$select = $db->query("SELECT * FROM fichier_technique WHERE id=$id");
	$fichier = $select->fetch();
	
	$file = SRC_DOC . "/" . $fichier['fabricant'] . "/" . $fichier['nom'] . $fichier['extension'];
	
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
    
    $select = $db->query("SELECT * FROM fichier_technique WHERE id=$id");
	$fichiers = $select->fetch();
	
	$res = unlink(SRC_DOC . '/' . $fichiers['fabricant'] . '/' . $fichiers['nom'] . $fichiers['extension']);
	
    $db->query("DELETE FROM fichier_technique WHERE id=$id");
    header('Location:./liste_doc.php');
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
                        Liste des documents techniques
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Bureau d'études
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Liste des documents techniques
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
			<form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFileTechnique">Nouveau fichier</button>
                    </div>
                </div>
            </form>
            
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="searchNomFichier" class="col-sm-1 control-label">Nom : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchNomFichier" placeholder="Nom">
                    </div>
                    <label for="searchRef" class="col-sm-2 control-label">Référence : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchRef" placeholder="Référence">
                    </div>
                    <label for="searchFabricant" class="col-sm-offset-1 col-sm-1 control-label">Fabricant : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchFabricant" placeholder="Fabricant">
                    </div>
                </div>
            </form>
            
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableFichierTech">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom fichier</th>
                                    <th>Nom produit</th>
                                    <th>Référence</th>
                                    <th>Fabricant</th>
                                    <th>Date d'ajout</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($fichiers_technique as $fichier_technique): ?>
                                    <tr>
                                        <td><?= $fichier_technique['id']; ?></td>
                                        <td><?= $fichier_technique['nom'].$fichier_technique['extension']; ?></td>
                                        <td><?= $fichier_technique['nom_produit']; ?></td>
                                        <td><?= $fichier_technique['ref']; ?></td>
                                        <td><?= $fichier_technique['fabricant']; ?></td>
                                        <td><?= $fichier_technique['date']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalDoc" id="LienModalDoc" data-toggle="modal" data-target="#modalModif" rel="<?= $fichier_technique['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $fichier_technique['id']; ?>" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                            <a href="?download=<?= $fichier_technique['id']; ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
								<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

			<!-- modal -->
            <div class="modal fade" id="newFileTechnique" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouveau fichier</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputFichier" class="col-sm-2 control-label">Fichier</label>
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
                                    <label for="inputNomProduit" class="col-sm-2 control-label">Nom du produit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNomProduit" name="inputNomProduit" placeholder="Nom du produit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputReference" class="col-sm-2 control-label">Référence</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputReference" name="inputReference" placeholder="Référence">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputFabricant" class="col-sm-2 control-label">Fabricant</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputFabricant" name="inputFabricant" placeholder="Fabricant">
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
                            <h4 class="modal-title">Modifier fichier</h4>
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

           
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../partials/footer_index.php'

?>