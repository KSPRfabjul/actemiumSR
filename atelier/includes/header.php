<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ecran atelier</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="<?= WEBROOT; ?>/atelier/libs/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= WEBROOT; ?>/atelier/libs/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?= WEBROOT; ?>/atelier/libs/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= WEBROOT; ?>atelier"><img src="<?= WEBROOT; ?>/atelier/libs/img/logo.png" class="img-responsive"/></a> 
            </div>
        </nav>   
        <!-- /. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li>
                    <a href="<?= WEBROOT; ?>atelier"><i class="fa fa-home fa-3x"></i> Accueil</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-building-o fa-3x"></i> L'entreprise<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/entreprise/be.php">Bureau d'étude</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/entreprise/atelier.php">Atelier</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/entreprise/chantier.php">Chantier</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/entreprise/organigramme.php">Organnigramme</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/entreprise/chiffres_clefs.php">Chiffres clés</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file fa-3x"></i> Plaquettes<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Nos offres<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/offres/tableaux.php">Tableaux</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/offres/shelters.php">Shelters</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/offres/robotique.php">Robotique</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/offres/energy.php">Energie efficiency</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/offres/solution.php">Solution partner</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Nos segments<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/segments/oil_gas.php">Oil & Gas</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/segments/materiaux.php">Materiaux</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/segments/environnement.php">Environnement</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/plaquettes/segments/chimie.php">Chimie</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= WEBROOT; ?>/atelier/views/site/site.php"><i class="fa fa-desktop fa-3x"></i> Site internet</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-3x"></i> Réalisations<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/realisations/chimie/chimie.php">Chimie/Pétrochimie</a>
                        </li>
                        <li>
                            <a href="#">Oil & Gas<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/realisations/oil_gas/presentation.php">Présentation</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/realisations/oil_gas/atex.php">Solution ATEX</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Environnemet<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/realisations/environnement/eau.php">Traitement de l'eau</a>
                                </li>
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/realisations/environnement/fumees.php">Traitement des fumées</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Energies<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?= WEBROOT; ?>/atelier/views/realisations/energies/shelters.php">Shelters</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>                    
                <li>
                    <a href="#"><i class="fa fa-ambulance fa-3x"></i> Sécurité<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/qhse.php">Politique Q.H.S.E.</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/revue_direction.php">Revue de direction</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/cr_revue_direction.php">Compte rendu de revue de direction</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/pase.php">P.A.S.E.</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/indicateur.php">Indicateurs mensuels</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT; ?>/atelier/views/securite/remontees.php">Remontées d'informations</a>
                        </li>
                    </ul>
                </li>               
                <li>
                    <a href="<?= WEBROOT; ?>/atelier/views/etat/etat.php"><i class="fa fa-list-alt fa-3x"></i> Etat analytique</a>
                </li>   
            </ul>
        </div> 
        </nav>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">