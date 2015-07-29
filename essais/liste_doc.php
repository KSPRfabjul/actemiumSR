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
                        Liste des documents techniques
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="<?= WEBROOT; ?>">Accueil</a>
                        </li>
                        <li>
                            Essais
                        </li>
                        <li class="active">
                            <i class="fa fa-eye"></i> Liste des documents techniques
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

           
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