<?php

include '../../lib/includes.php';


/**
 * SELECTION DES CATEGORIES
 */
$select = $db->query("SELECT * FROM categorie");
$categories = $select->fetchAll();

/**
 * SELECTION DE TOUS LES FICHIERS
 */
$select = $db->query("SELECT F.id AS id, F.nom AS nom, F.extension AS extension, C.nom AS nom_categorie, S.nom AS nom_sous_categorie, DATE_FORMAT(date, '%d-%m-%Y') AS date, version FROM fichier_matrice F, categorie C, sscat S WHERE F.id_cat=C.id AND F.id_sscat=S.id");
$fichiers_matrice = $select->fetchAll();


if(isset($_POST['hidden'])){

	/**
	 * INSERTION DANS LA BASE
	 */
	if($_POST['hidden'] == 'insert'){
	
		$files = $_FILES['files'];
		$fichiers = array();
		
	    $date = $db->quote(date("Y-m-d"));
	    $nom = $db->quote($_POST['inputNom']);
	    $id_categorie = $db->quote($_POST['inputCategorie']);
	    $id_sous_categorie = $db->quote($_POST['inputSousCategorie']);
	    $version = $db->quote($_POST['inputVersion']);
		
		foreach($files['tmp_name'] as $k => $v){
			$fichiers = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
			$db->query("INSERT INTO fichier_matrice SET id_cat=$id_categorie, id_sscat=$id_sous_categorie, version=$version, date=$date");
            $fichier_id = $db->lastInsertId();
            
            $select = $db->query("SELECT nom FROM categorie WHERE id=$id_categorie");
            $nom_categorie = $select->fetch();
            
            $select = $db->query("SELECT nom FROM sscat WHERE id=$id_sous_categorie");
            $nom_sous_categorie = $select->fetch();
            
            $fichier_name = $_POST['inputNom'] . '.' . $extension;
            move_uploaded_file($fichiers['tmp_name'], SRC_MATRICE . $nom_categorie['nom'] . '/' . $nom_sous_categorie['nom'] . '/' . $fichier_name);
            
            $extension = '.' . $extension;
            $extension = $db->quote($extension);
            $db->query("UPDATE fichier_matrice SET nom=$nom, extension=$extension WHERE id=$fichier_id");
		}
		
		setFlash('Fichier ajouté');
	    header('Location:' . WEBROOT . 'modules/documents/matrice_doc.php');
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
		    $id_categorie = $db->quote($_POST['inputCategorie']);
		    $id_sous_categorie = $db->quote($_POST['inputSousCategorie']);
		    $version = $db->quote($_POST['inputVersion']);
		    
		    var_dump("SELECT F.nom AS nom, F.extension AS extension, C.nom AS categorie, S.nom AS sous_categorie FROM fichier_matrice F, categorie C, sscat S WHERE F.id=$ancienId AND F.id_cat=C.id AND F.id_sscat=S.id");
		    $select = $db->query("SELECT F.nom AS nom, F.extension AS extension, C.nom AS categorie, S.nom AS sous_categorie FROM fichier_matrice F, categorie C, sscat S WHERE F.id=$ancienId AND F.id_cat=C.id AND F.id_sscat=S.id");
		    $ancien_fichier = $select->fetch();
		    var_dump($ancien_fichier);
		    
		    var_dump("UPDATE fichier_matrice SET nom=$nom, id_cat=$id_categorie, id_sscat=$id_sous_categorie, version=$version, date=$date WHERE id=$ancienId");
		    $db->query("UPDATE fichier_matrice SET nom=$nom, id_cat=$id_categorie, id_sscat=$id_sous_categorie, version=$version, date=$date WHERE id=$ancienId");
		    

		    $select = $db->query("SELECT nom FROM categorie WHERE id=$id_categorie");
            $nom_categorie = $select->fetch();
            
            $select = $db->query("SELECT nom FROM sscat WHERE id=$id_sous_categorie");
            $nom_sous_categorie = $select->fetch();
		    
			rename(SRC_MATRICE . $ancien_fichier['categorie'] . '/' . $ancien_fichier['sous_categorie'] . '/' . $ancien_fichier['nom'] . $ancien_fichier['extension'], SRC_MATRICE . $nom_categorie['nom'] . '/' . $nom_sous_categorie['nom'] . '/' . $_POST['inputNom'] . $ancien_fichier['extension']);
//			unlink();
		    
		    setFlash('Fichier modifié');
		    header('Location:' . WEBROOT . '/modules/documents/matrice_doc.php');
		    die();
		    
		} else {
			
			$fichiers = array();
						
			$ancienId = $db->quote($_POST['inputId']);
			$date = $db->quote(date("Y-m-d"));
		    $nom = $db->quote($_POST['inputNom']);
		    $id_categorie = $db->quote($_POST['inputCategorie']);
		    $id_sous_categorie = $db->quote($_POST['inputSousCategorie']);
		    $version = $db->quote($_POST['inputVersion']);
		    
		    // Selection du fichier associé
		    $select = $db->query("SELECT F.nom AS nom, F.extension AS extension, C.nom AS categorie, S.nom AS sous_categorie FROM fichier_matrice F, categorie C, sscat S WHERE F.id=$ancienId AND C.id=F.id_cat AND S.id=F.id_sscat");
		    $ancien_fichier = $select->fetch();
		    
		    // Suppression de l'ancien fichier
		    unlink(SRC_MATRICE . $ancien_fichier['categorie'] . '/' . $ancien_fichier['sous_categorie'] . '/' . $ancien_fichier['nom'] . $ancien_fichier['extension']);
		    $db->query("DELETE FROM fichier_matrice WHERE id=$ancienId");
			
			foreach($files['tmp_name'] as $k => $v){
				$fichiers = array(
					'name' => $files['name'][$k],
					'tmp_name' => $files['tmp_name'][$k]
				);
				
				$extension = pathinfo($fichiers['name'], PATHINFO_EXTENSION);
				$db->query("INSERT INTO fichier_matrice SET id_cat=$id_categorie, id_sscat=$id_sous_categorie, version=$version, date=$date");
	            $fichier_id = $db->lastInsertId();
	            
	            $select = $db->query("SELECT nom FROM categorie WHERE id=$id_categorie");
	            $nom_categorie = $select->fetch();
	            
	            $select = $db->query("SELECT nom FROM sscat WHERE id=$id_sous_categorie");
	            $nom_sous_categorie = $select->fetch();
	            
	            $fichier_name = $_POST['inputNom'] . '.' . $extension;
	            move_uploaded_file($fichiers['tmp_name'], SRC_MATRICE . $nom_categorie['nom'] . '/' . $nom_sous_categorie['nom'] . '/' . $fichier_name);
	            
	            $extension = '.' . $extension;
	            $extension = $db->quote($extension);
	            $db->query("UPDATE fichier_matrice SET nom=$nom, extension=$extension WHERE id=$fichier_id");
			}
		    
		}
		
		setFlash('Fichier modifié');
	    header('Location:' . WEBROOT . 'modules/documents/matrice_doc.php');
	    die();
		
	}

}


/**
* SUPPRESSION DOCUMENT
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);
    
    $select = $db->query("SELECT F.id AS id, F.nom AS nom, F.extension AS extension, C.nom AS nom_categorie, S.nom AS nom_sous_categorie, date, version FROM fichier_matrice F, categorie C, sscat S WHERE F.id_cat=C.id AND F.id_sscat=S.id AND F.id=$id");
	$fichiers = $select->fetch();
	
	$res = unlink(SRC_MATRICE . $fichiers['nom_categorie'] . '/' . $fichiers['nom_sous_categorie'] . '/' . $fichiers['nom'] . $fichiers['extension']);
	
    $db->query("DELETE FROM fichier_matrice WHERE id=$id");
    header('Location:./matrice_doc.php');
}


/**
 * TELECHARGEMENT DU DOCUMENT
 */
if(isset($_GET['download'])){

	$id = $db->quote($_GET['download']);
	$select = $db->query("SELECT F.nom AS nom, F.extension AS extension, C.nom AS categorie, S.nom AS sous_categorie FROM fichier_matrice F, categorie C, sscat S WHERE F.id=$id AND F.id_cat=C.id AND F.id_sscat=S.id");
	$fichier = $select->fetch();
	
	$file = SRC_MATRICE . $fichier['categorie'] . "/" . $fichier['sous_categorie'] . "/" . $fichier['nom'] . $fichier['extension'];
	
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
 * COPIE DES FICHIERS SUR LA CARTE USB
 */
if(isset($_GET['copy'])){

	
	$nom = strtoupper($_SESSION['Auth']['nom']);

	$dest = SRC_USB . $nom . '/MATRICE';
	
	if(file_exists($dest)){
		rmRecursive($dest);
	}

	umask(0000);
	mkdir($dest, 0777, true);	
	var_dump("dossier créé");
	
	$src = SRC_MATRICE;
	var_dump($src);
	
	smartCopy($src, $dest);
	var_dump("recursive");
	
	setFlash('Carte USB mise à jour');
    header('Location:' . WEBROOT . 'modules/documents/matrice_doc.php');
    die();
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
                        Matrice documentaire
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Gestion documentaire
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Matrice documentaire
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

           <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFile">Ajouter fichier</button>
                        <a class="btn btn-primary" href="param_matrice.php">Paramétrer matrice</a>
                        <a class="btn btn-primary" href="?copy=true">Mettre à jour carte USB</a>
                    </div>
                </div>
            </form>
            
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="selectTriMatrice" class="col-sm-2 control-label">Trier par : </label>
                    <div class="col-sm-3">
                        <select class="form-control" name="selectTriMatrice" id="selectTriMatrice" onchange="go_tri()">
                            <option value="">Catégorie</option>
							<?php foreach($categories as $categorie): ?>
                                <option value="<?= $categorie['id']; ?>"><?= $categorie['nom']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="selectTriSousMatrice" id="selectTriSousMatrice">
                            <option value="">Sous-catégorie</option>
                        </select>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableFichiers">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fichier</th>
                                    <th>Catégorie</th>
                                    <th>Sous-catégorie</th>
                                    <th>Date mise à jour</th>
                                    <th>Version</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach($fichiers_matrice as $fichier_matrice): ?>
                                    <tr>
                                        <td><?= $fichier_matrice['id']; ?></td>
                                        <td><?= $fichier_matrice['nom'].$fichier_matrice['extension']; ?></td>
                                        <td><?= $fichier_matrice['nom_categorie']; ?></td>
                                        <td><?= $fichier_matrice['nom_sous_categorie']; ?></td>
                                        <td><?= $fichier_matrice['date']; ?></td>
                                        <td><?= $fichier_matrice['version']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalMatrice" id="LienModalMatrice" data-toggle="modal" data-target="#modalModif" rel="<?= $fichier_matrice['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $fichier_matrice['id']; ?>" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                            <a href="?download=<?= $fichier_matrice['id']; ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
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
            <div class="modal fade" id="newFile" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouveau document</h4>
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
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom du document">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCategorie" class="col-sm-2 control-label">Catégorie</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="inputCategorie" id="inputCategorie" onchange='go()'>
                                            <option value=""></option>
                                            <?php foreach($categories as $categorie): ?>
                                                <option value="<?= $categorie['id']; ?>"><?= $categorie['nom']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSousCategorie" class="col-sm-2 control-label">Sous-catégorie</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="inputSousCategorie" id="inputSousCategorie">
                                            <option value=""></option>
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


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../partials/footer_index.php'

?>