<?php
include '../../lib/errors.php';

include '../../lib/includes.php';

/**
 * SELECTION DE TOUTES LES CATEGORIES
 */
$select = $db->query("SELECT * FROM categorie ORDER BY ID ASC");
$categories = $select->fetchAll();


if(isset($_POST['hidden'])){

	/**
	 * INSERTION DANS LA BASE
	 */
	if($_POST['hidden'] == 'insert'){
	
	    $nom = $db->quote($_POST['inputNom']);

		$select = $db->query("SELECT * FROM categorie WHERE nom=$nom");
		if($select->rowCount() == 0){
	    	$db->query("INSERT INTO categorie SET nom=$nom");
			umask(0000);
			mkdir(SRC_MATRICE. $_POST['inputNom'], 0777);
		    $lastId = $db->lastInsertId();
		    $lastId = $db->quote($lastId);
		} else {
			setFlash('Catégorie existante', 'danger');
			header('Location:param_matrice.php');
			die();
		}
	    
		foreach ($_POST['sscat'] as $sscat):
	    	if($sscat != ""){
	    		$sscatq = $db->quote($sscat);
	    		$db->query("INSERT INTO sscat SET nom=$sscatq, id_cat=$lastId");	
				umask(0000);
				mkdir(SRC_MATRICE. $_POST['inputNom'] . '/' . $sscat, 0777);
	    	}
	    endforeach;
	    
	    setFlash('Catégorie créée');
	    header('Location:param_matrice.php');
	    die();
	}
	
	/**
	 * MAJ DANS LA BASE DES CATEGORIES
	 */
	if($_POST['hidden'] == 'updateCategorie'){
	
	    $nom = $db->quote($_POST['inputNom']);
	    $id = $db->quote($_POST['inputId']);
	    
	    $select = $db->query("SELECT * FROM categorie WHERE id=$id");
	    $categorie = $select->fetch();
	    
		rename(SRC_MATRICE . $categorie['nom'], SRC_MATRICE . $_POST['inputNom']);		
		$db->query("UPDATE categorie SET nom=$nom WHERE id=$id");


	    setFlash('Catégorie modifiée');
	    header('Location:param_matrice.php');
	    die();

	}
	
	/**
	 * MAJ DANS LA BASE DES SOUS-CATEGORIES
	 */
	if($_POST['hidden'] == 'updateSousCategorie'){
	
	    $nom = $db->quote($_POST['inputNom']);
	    $id = $db->quote($_POST['inputId']);
	    
	    $select = $db->query("SELECT C.nom AS nom FROM categorie C, sscat S WHERE S.id=$id AND C.id=S.id_cat");
	    $categorie = $select->fetch();
	    
	    $select = $db->query("SELECT * FROM sscat WHERE id=$id");
	    $sscat = $select->fetch();

		rename(SRC_MATRICE . $categorie['nom'] . '/' . $sscat['nom'], SRC_MATRICE . $categorie['nom'] . '/' . $_POST['inputNom']);	
		$db->query("UPDATE sscat SET nom=$nom WHERE id=$id");

	    setFlash('Sous-Catégorie modifiée');
	    header('Location:param_matrice.php');
	    die();

	}

}

/**
* SUPPRESSION CATEGORIE
**/
if(isset($_GET['delete'])){
    $id = $db->quote($_GET['delete']);

	$select = $db->query("SELECT * FROM categorie WHERE id=$id");
	$categorie = $select->fetch();
	
	$select = $db->query("SELECT * FROM fichier_matrice WHERE id_cat=$id");
	$fichiers_matrice2 = $select->fetchAll();

	rmRecursive(SRC_MATRICE . $categorie['nom']);
	
	foreach($fichiers_matrice2 as $fichier_matrice2):
		$id_fichier = $db->quote($fichier_matrice2['id']);
		$db->query("DELETE FROM fichier_matrice WHERE id=$id_fichier");
	endforeach;
    
    $db->query("DELETE FROM categorie WHERE id=$id");
    header('Location:./param_matrice.php');
}

/**
* SUPPRESSION SOUS-CATEGORIE
**/
if(isset($_GET['deletesscat'])){
    $id = $db->quote($_GET['deletesscat']);

	$select = $db->query("SELECT C.nom AS nom_categorie, S.nom AS nom_sous_categorie FROM sscat S, categorie C WHERE S.id=$id AND S.id_cat=C.id");
	$sscat = $select->fetch();
	
	$select = $db->query("SELECT * FROM fichier_matrice WHERE id_sscat=$id");
	$fichiers_matrice = $select->fetchAll();

	rmRecursive(SRC_MATRICE . $sscat['nom_categorie'] . '/' . $sscat['nom_sous_categorie']);
	
	foreach($fichiers_matrice as $fichier_matrice):
		$id_fichier = $db->quote($fichier_matrice['id']);
		$db->query("DELETE FROM fichier_matrice WHERE id=$id_fichier");
	endforeach;
    
    $db->query("DELETE FROM sscat WHERE id=$id");
    header('Location:./param_matrice.php');
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
                        Paramétrer matrice
                    </h1>
                </div>
            </div>
            <!-- /.row -->

           <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <a class="btn btn-primary" href="matrice_doc.php">Retour</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCategorie">Ajouter catégorie</button>
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
                                    <th>Catégorie</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php foreach($categories as $categorie): ?>
                                    <tr>
                                        <td><?= $categorie['id']; ?></td>
                                        <td><?= $categorie['nom']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary LienModalCategorie" id="#LienModalCategorie" data-toggle="modal" data-target="#modalModif" rel="<?= $categorie['id']; ?>">Modifier</button>
                                            <a href="?delete=<?= $categorie['id']; ?>" class="btn btn-default" onclick="return confirm('Cette action supprimera la categorie et tous les fichiers associés, continuer?');">Supprimer</a>
                                        </td>
                                        <td class="text-right"><a href="javascript:;" class="btn btn-default" data-toggle="collapse" data-target="#sscat<?= $categorie['id']; ?>">Afficher sous-catégories <i class="fa fa-fw fa-caret-down"></i></a></td>
                                    </tr>
                                    <tr id="sscat<?= $categorie['id']; ?>" class="collapse">
                                    	<?php
                                    		/**
											 * SELECTION DE TOUTES LES SOUS-CATEGORIES
											 */
											$id_cat = $db->quote($categorie['id']);
											$select2 = $db->query("SELECT * FROM sscat WHERE id_cat=$id_cat ORDER BY nom ASC");
											$sscats = $select2->fetchAll();
                                    	?>
                                    	<td colspan="4">
	                                    	<table class="table table-hover table-striped">
	                                    		<thead>
	                                    			<tr>
		                                    			<th>ID</th>
		                                    			<th>Sous-catégories</th>
		                                    			<th></th>
	                                    			</tr>
	                                    		</thead>
	                                    		<tbody>
	                                    			<?php foreach($sscats as $sscat): ?>
		                                    		<tr>
		                                    			<td><?= $sscat['id']; ?></td>
		                                    			<td><?= $sscat['nom']; ?></td>
		                                    			<td>
		                                    				<button type="button" class="btn btn-primary LienModalSousCategorie" id="#LienModalSousCategorie" data-toggle="modal" data-target="#modalModifSSCategorie" rel="<?= $sscat['id']; ?>">Modifier</button>
															<a href="?deletesscat=<?= $sscat['id']; ?>" class="btn btn-default" onclick="return confirm('Cette action supprimera la sous-categorie et tous les fichiers associés, continuer?');">Supprimer</a>
														</td>
		                                    		</tr>
		                                    		<?php endforeach; ?>
	                                    		</tbody>
	                                    	</table>
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
            <div class="modal fade" id="newCategorie" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouvelle catégorie</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Nom de la catégorie">
                                    </div>
                                </div>
                                <legend class="scheduler-border">Sous-catégorie</legend>
                                <div class="form-group">
                                	<label for="inputSscat" class="col-sm-3 control-label">Sous catégorie</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputSscat" name="sscat[]" placeholder="Nom de la sous-catégorie">
                                    </div>
						        </div>
                                <div class="form-group hidden" id="duplicate">
                                	<label for="inputSscat" class="col-sm-3 control-label">Sous catégorie</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputSscat" name="sscat[]" placeholder="Nom de la sous-catégorie">
                                    </div>
						        </div>
						        <p class="text-right">
						            <a href="#" class="btn btn-default" id="duplicatebtn">Ajouter une sous-catégorie <i class="fa fa-plus-circle"></i></a>
						        </p>
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
                            <h4 class="modal-title">Modifier catégorie</h4>
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
            
            <div class="modal fade" id="modalModifSSCategorie" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modifier sous-catégorie</h4>
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