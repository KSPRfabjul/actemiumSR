<?php

/**
* SELECTION DE TOUTES LES DISPONIBILITES
**/
$select = $db->query("SELECT * FROM disponibilite ORDER BY id ASC");
$disponibilites2 = $select->fetchAll();

/**
*  SELECTION DE TOUTES LES NEWS
**/
$select = $db->query("SELECT * FROM news ORDER BY date DESC LIMIT 5");
$news = $select->fetchAll();

?>

<!-- Navigation -->
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

    <!-- Elements barre de menu supérieure -->
    <ul class="nav navbar-right top-nav">
        
        <!--
<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-newspaper-o"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
	            <?php foreach($news as $new): ?>
	            	<li class="message-preview">
	            		<a href="#">
	            			<div class="media">
	            				<div class="media-body">
	            					<p class="small text-muted"><i class="fa fa-clock-o"></i> <?= $new['date']; ?></p>
	            					<p><?= $new['message']; ?></p>
	            				</div>
	            			</div>
	            		</a>
	            	</li>
                <?php endforeach; ?>
                <li class="message-footer">
                    <a href="#">Voir toute les news</a>
                </li>
            </ul>
        </li>
-->
	    
<!--
        <li>
            <select class="form-control" name="dispo" id="dispo">
                <option value=""></option>
                <?php foreach($disponibilites2 as $disponibilite2): ?>
                    <option value="<?= $disponibilite2['id']; ?>" <?php if($disponibilite2['id'] == $_SESSION['Auth']['disponibilite']){ echo "selected"; } ?>><?= $disponibilite2['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </li>
-->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?= ' ' . $_SESSION['Auth']['prenom'] . ' ' . $_SESSION['Auth']['nom']; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?= WEBROOT; ?>/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Menu latéral - Se réduit lors de l'affichage sur mobile -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="<?= WEBROOT; ?>/index.php"><i class="fa fa-fw fa-home fa-2x"></i> Accueil</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#visite"><i class="fa fa-fw fa-eye fa-2x"></i> Visite <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="visite" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>modules/visite/visite.php">Liste visites</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/visite/visiteur.php">Annuaire Visiteurs</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/visite/programmer_visite.php">Programmer une visite</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#document"><i class="fa fa-fw fa-paperclip fa-2x"></i> Gestion doc. <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="document" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>modules/documents/creation_affaire.php">Création affaire</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/documents/matrice_doc.php">Matrice doc.</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#be"><i class="fa fa-fw fa-book fa-2x"></i> BE <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="be" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>/modules/be/liste_doc.php">Documents techniques</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>/modules/be/nomenclatures.php">Nomenclatures</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>/modules/be/reperes.php">Repères</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#essais"><i class="fa fa-fw fa-flask fa-2x"></i> Essais <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="essais" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>modules/essais/liste_doc.php">Documents techniques</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>/essais/rapport.php">Rapport de contrôle</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#magasin"><i class="fa fa-fw fa-archive fa-2x"></i> Magasin/Stock <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="magasin" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>modules/magasin/materiel.php">Liste de matériels</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/magasin/nomenclatures.php">Nomenclatures</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/magasin/entrant_sortant.php">Entrant/Sortant</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#interne"><i class="fa fa-fw fa-cogs fa-2x"></i> Gestion interne <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="interne" class="collapse">
                    <li>
                        <a href="<?= WEBROOT; ?>modules/parametres/ecran.php">Modifier écran d'accueil</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>modules/parametres/ecran.php">Modifier écran atelier</a>
                    </li>
                    <li class="active">
                        <a href="<?= WEBROOT; ?>modules/parametres/personnel.php">Liste utilisateurs</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>