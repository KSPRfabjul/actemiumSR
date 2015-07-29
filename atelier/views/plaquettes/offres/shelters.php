<?php
include '../../../libs/php/includes.php';
include '../../../includes/header.php';
?>

<div class="row">
	<div class="col-md-12">
		<h2>Shelters</h2>
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
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="<?= WEBROOT; ?>/libs/img/plaquettes/offres/shelters/shelters-P1.jpg" alt="page 1">
				</div>

				<div class="item">
					<img src="<?= WEBROOT; ?>/libs/img/plaquettes/offres/shelters/shelters-P2.jpg" alt="page 2">
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
include '../../../includes/footer.php';
?>