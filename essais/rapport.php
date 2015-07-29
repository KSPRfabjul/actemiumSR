<?php

include '../lib/includes.php';

include '../partials/header_index.php'

?>

<div id="wrapper">

    <?php include '../partials/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Rapports de contrôle
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Essais
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Rapports de contrôle
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            
			<form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newNomen">Nouveau rapport</button>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>123456</td>
                                    <td>10-01-2015</td>
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
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include '../partials/footer_index.php'

?>