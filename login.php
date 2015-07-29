<?php

$auth = 0;
include 'lib/includes.php';

/**
* TRAITEMENT DU FORMULAIRE
**/
if(isset($_POST['inputIndentifiant']) && isset($_POST['inputPassword'])){
    $username = $db->quote($_POST['inputIndentifiant']);
    $password = sha1($_POST['inputPassword']);
    $select = $db->query("SELECT * FROM salarie WHERE identifiant=$username AND mdp='$password'");
    if($select->rowCount() > 0){
        $_SESSION['Auth'] = $select->fetch();
        setFlash('Vous êtes maintenant connecté');
        /*if($_SESSION['Auth']['id_status'] == 1){*/
            header('Location:' . WEBROOT . 'index.php');
        /*} else if($_SESSION['Auth']['id_status'] == 2){*/
        /*    header('Location:' . WEBROOT . 'index_admin.php');*/
        /*}*/
        die();
    }
}


include 'partials/header_login.php'

?>

<div id="wrapper"><!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Affichage logo et outils pour affichage sur mobile -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand"><img class="img-responsive img-brand" src="<?= WEBROOT; ?>/img/logo_brand_b.bmp" alt="" /></a>
        </div>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Identification
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Identification
                        </li>
                    </ol>
                    <div class="col-lg-offset-3 col-lg-6">
                        <form class="form-horizontal formLogin" method="post" action="#">
                            <div class="form-group">
                                <label for="inputIndentifiant" class="col-sm-2 control-label">Identifiant</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputIndentifiant"  name='inputIndentifiant' placeholder="Identifiant">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-2 control-label">Mot de passe</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Mot de passe">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
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
include 'lib/debug.php';
include 'partials/footer_index.php';

?>