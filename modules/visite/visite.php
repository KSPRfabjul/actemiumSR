<?php

include '../../lib/errors.php';
include '../../lib/includes.php';


/**
* SELECTION DE TOUTES LES VISITES
**/
$select = $db->query("SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY id DESC");
$visites = $select->fetchAll();


/**
 * EXPORTATION AU FORMAT .CSV
 */
if(isset($_GET['export'])){
	
	$exportCsv = '';
	$fileName = 'exportVisites.csv';
	
	$requete = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison FROM date D, visiteur V WHERE D.id_visiteur=V.id ORDER BY DATE ASC";
	
	$select = $db->query($requete);
	$select->setFetchMode(PDO::FETCH_OBJ);
	
	if($select->rowCount() != 0){
		$i = 0;
		
		while($row = $select->fetch()){
			$i++;
			
			if($i == 1){
				foreach($row as $clef => $valeur){
					$exportCsv .= trim($clef).';';
				}
				
				$exportCsv = rtrim($exportCsv, ';');
				$exportCsv .= "\n";
			}
			
			foreach($row as $clef => $valeur){
				$exportCsv .= trim($valeur).';';
			}
			$exportCsv = rtrim($exportCsv, ';');
			$exportCsv .= "\n";
			
		}
	}
	
	header("Content-disposition: attachment; filename=".$fileName);
	header("Content-Type: application/force-download");
	header("Content-Transfer-Encoding: application/vnd.ms-excel\n");
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
	header("Expires: 0");
	
	echo $exportCsv;
	exit();
	
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
                        Liste des visites
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Visite
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Liste des visites
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <form class="form-horizontal">
                <div class="form-group">
                    <label for="selectTri" class="col-sm-2 control-label">Trier par : </label>
                    <div class="col-sm-3">
                        <select class="form-control" name="selectTri" id="selectTri">
                            <option value=""></option>
                            <option value="date">Date</option>
                            <option value="nom">Nom</option>
                            <option value="entreprise">Entreprise</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="selectOrdre" id="selectOrdre">
                            <option value=""></option>
                            <option value="ASC">Ascendant</option>
                            <option value="DESC">Descendant</option>
                        </select>
                    </div>
                </div>
            </form>
            
           <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-1">
                        <a class="btn btn-primary" href="?export=true">Exporter au format .csv</a>
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
                                    <th>Nom</th>
                                    <th>Entreprise</th>
                                    <th>Raison visite</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($visites as $visite): ?>
                                    <tr>
                                        <td><?= $visite['id']; ?></td>
                                        <td><?= $visite['date']; ?></td>
                                        <td><?= $visite['nom'].' '.$visite['prenom']; ?></td>
                                        <td><?= $visite['entreprise']; ?></td>
                                        <td><?= $visite['raison']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm LienModalDetailVisite" id="#LienModalDetailVisite" data-toggle="modal" data-target="#modalVisite" rel="<?= $visite['id']; ?>">Plus d'info.</button>
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
            <div class="modal fade" id="modalVisite" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Information visite</h4>
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
            <!-- /.modal -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../partials/footer_index.php'

?>