<?php
include '../../libs/php/includes.php';
include '../../includes/header.php';
?>

<div class="row">
	<div class="col-md-12">
		<h2>Compte rendu de revue de direction</h2>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
				<li data-target="#myCarousel" data-slide-to="4"></li>
				<li data-target="#myCarousel" data-slide-to="5"></li>
				<li data-target="#myCarousel" data-slide-to="6"></li>
				<li data-target="#myCarousel" data-slide-to="7"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-1.jpg" alt="page 1">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-2.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-3.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-4.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-5.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-6.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-7.jpg" alt="page 2">
				</div>
				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/securite/cr_revue_direction/cr_revue_direction-8.jpg" alt="page 2">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
<!-- /. ROW  -->

<?php
include '../../includes/footer.php';
?>
         