<?php

include '../../lib/includes.php';


/**
 * SELECTION DE TOUS LES DOCUMENTS
 */


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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newFile">Nouveau document</button>
                    </div>
                </div>
            </form>
            
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="searchNom" class="col-sm-offset-1 col-sm-1 control-label">Fabricant : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchNom" placeholder="Fabricant">
                    </div>
                    <label for="searchEntreprise" class="col-sm-1 control-label">Nom : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchEntreprise" placeholder="Nom">
                    </div>
                    <label for="searchEntreprise" class="col-sm-2 control-label">Référence : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="searchEntreprise" placeholder="Référence">
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
                                    <th>Nom</th>
                                    <th>Référence</th>
                                    <th>Fabricant</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Doc technique</td>
                                    <td>Ref. 123456</td>
                                    <td>Fabricant</td>
                                    <td>
                                        <button type="button" class="btn btn-primary LienModalVisite" id="#LienModalVisite" data-toggle="modal" data-target="#modalModif" rel="">Modifier</button>
                                        <a href="" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                        <a href="" class="btn btn-default"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
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