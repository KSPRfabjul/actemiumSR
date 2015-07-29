<?php

include '../../lib/includes.php';

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
                        Entrant/Sortant
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Magasin/Stock
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/modules/magasin/entrant_sortant.php">Entrant/Sortant</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Non affecté
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tableVisiteurs">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code barre</th>
                                    <th>Reference</th>
                                    <th>Marque</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <th>Emplacement</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1234556432</td>
                                    <td><input type="text" class="form-control" id="exampleInputName2" placeholder="Référence"></td>
                                    <td><input type="text" class="form-control" id="exampleInputName2" placeholder="Marque"></td>
                                    <td><input type="text" class="form-control" id="exampleInputName2" placeholder="Désignation"></td>
                                    <td><input type="text" class="form-control" id="exampleInputName2" placeholder="Quantité"></td>
                                    <td><input type="text" class="form-control" id="exampleInputName2" placeholder="Emplacement"></td>
                                    <td>
                                        <i class="fa fa-floppy-o fa-2x"></i>
                                    </td>
                                </tr>
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
                            <form class="form-horizontal" method="POST" action="#">
                                <div class="form-group">
                                    <label for="inputFichier" class="col-sm-2 control-label">Nomenclature</label>
			                        <div class="col-sm-10">
			                            <input type="file" name="images[]">
			                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Affaire</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Affaire">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Version</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Version">
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

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../../partials/footer_index.php'

?>