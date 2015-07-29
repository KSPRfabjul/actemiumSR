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
                        Matériels
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Magasin/Stock
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Matériels
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
			<form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newProduit">Nouveau produit</button>
                    </div>
                </div>
            </form>
            
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="searchNom" class="col-sm-1 control-label">Nom : </label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="searchNom" placeholder="Nom">
                    </div>
                    <label for="searchNom" class="col-sm-1 control-label">Réf. : </label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="searchNom" placeholder="Référence">
                    </div>
                    <label for="searchNom" class="col-sm-1 control-label">Fabricant : </label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="searchNom" placeholder="Fabricant">
                    </div>
                    <label for="searchEntreprise" class="col-sm-1 control-label">Empl. : </label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" id="searchEntreprise" placeholder="Emplacement">
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newNomen">Seuil mini</button>
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
                                    <th>Emplacement</th>
                                    <th>Quantité</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nom produit</td>
                                    <td>Référence</td>
                                    <td>Fabricant</td>
                                    <td>Emplacement</td>
                                    <td>2</td>
                                    <td>
                                        <button type="button" class="btn btn-primary LienModalVisite" id="#LienModalVisite" data-toggle="modal" data-target="#modalModif" rel="">Modifier</button>
                                        <a href="" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                    </td>
                                </tr>
                                <tr class="danger">
                                    <td>1</td>
                                    <td>Nom produit</td>
                                    <td>Référence</td>
                                    <td>Fabricant</td>
                                    <td>Emplacement</td>
                                    <td>0</td>
                                    <td>
                                        <button type="button" class="btn btn-primary LienModalVisite" id="#LienModalVisite" data-toggle="modal" data-target="#modalModif" rel="">Modifier</button>
                                        <a href="" class="btn btn-default" onclick="return confirm('Sur de sur ?');">Supprimer</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            
            <!-- modal -->
            <div class="modal fade" id="newProduit" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nouveau produit</h4>
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
                                    <label for="inputNom" class="col-sm-2 control-label">Référence</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Référence">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Fabricant</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Fabricant">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Emplacement</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Emplacement">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Quantité actuelle</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Quantité">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputNom" class="col-sm-2 control-label">Quantité minimale</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Quantité">
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