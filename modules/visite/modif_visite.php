<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $_POST['id'];

$req = "SELECT * FROM visite_future WHERE id=$id";
$select = $db->query($req);
$visite = $select->fetch();

echo "
    <link href=\"../css/datepicker.min.css\" rel=\"stylesheet\" />
    <link href=\"../css/datepicker3.min.css\" rel=\"stylesheet\" />
    <link href=\"../css/bootstrap-formhelpers.min.css\" rel=\"stylesheet\" />

	<script src=\"../js/framework/bootstrap.js\"></script>
	<script src=\"../js/bootstrap-datepicker.min.js\"></script>
	<script src=\"../js/bootstrap-formhelpers.js\"></script>

	<script type=\"text/javascript\">
		$(document).ready(function() {
		    $('#datePicker2').datepicker({
		        format: 'yyyy-mm-dd'
		    });
		});
	</script>

	<style>
		#datePicker{
			z-index: 1000 !important;
		}
	</style>

	<form class=\"form-horizontal\" action=\"#\" method=\"POST\">
	    <div class=\"form-group\">
	        <label for=\"datePicker2\" class=\"col-sm-2 control-label\">Date</label>
	        <div class=\"col-sm-10\">
	            <div class=\"input-group input-append date\" id=\"datePicker2\">
	                <input type=\"text\" class=\"form-control\" name=\"date\" id=\"date\" value=\"".$visite['date']."\"/>
	                <span class=\"input-group-addon add-on\"><span class=\"glyphicon glyphicon-calendar\"></span></span>
	            </div>
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <label for=\"inputPersonnes\" class=\"col-sm-2 control-label\">Personnes</label>
	        <div class=\"col-sm-10\">
	            <textarea class=\"form-control\" rows=\"3\" name=\"inputPersonnes\" id=\"inputPersonnes\">".$visite['personnes']."</textarea>
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <label for=\"inputSociete\" class=\"col-sm-2 control-label\">Société</label>
	        <div class=\"col-sm-10\">
	            <input type=\"text\" class=\"form-control\" name=\"inputSociete\" id=\"inputSociete\" placeholder=\"Société\" value=\"".$visite['societe']."\">
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <label for=\"inputRaison\" class=\"col-sm-2 control-label\">Raison visite</label>
	        <div class=\"col-sm-10\">
	            <textarea class=\"form-control\" rows=\"3\" name=\"inputRaison\" id=\"inputRaison\">".$visite['raison']."</textarea>
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <div class=\"col-sm-offset-2 col-sm-10\">
	            <div class=\"checkbox\">
	                <label>";
	                if($visite['viennoiserie'] == 1){
	                    echo "<input type=\"checkbox\" name=\"inputViennoiserie\" id=\"inputViennoiserie\" checked> Viennoiseries ?";
	                } else {
	                	echo "<input type=\"checkbox\" name=\"inputViennoiserie\" id=\"inputViennoiserie\"> Viennoiseries ?";
	                }
			   echo "</label>
	            </div>
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <div class=\"col-sm-offset-2 col-sm-10\">
	            <div class=\"checkbox\">
	                <label>";
	                if($visite['restaurant'] == 1){
	                    echo "<input type=\"checkbox\" name=\"inputRestaurant\" id=\"inputRestaurant\" checked> Restaurant ?";
	                } else {
	                	echo "<input type=\"checkbox\" name=\"inputRestaurant\" id=\"inputRestaurant\"> Restaurant ?";
	                }
			   echo "</label>
	            </div>
	        </div>
	    </div>
	    <div class=\"form-group\">
	        <label for=\"inputNbPersonne\" class=\"col-sm-5 control-label\">Nombre de personnes</label>
	        <div class=\"col-sm-7\">
	            <input type=\"text\" class=\"form-control bfh-number\" name=\"inputNbPersonne\" id=\"inputNbPersonne\" value=\"".$visite['nb_personne']."\">
	        </div>
	    </div>
	    <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
        <input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"update\">
	    <div class=\"form-group\">
	        <div class=\"col-sm-offset-2 col-sm-10\">
	            <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
	        </div>
	    </div>
	</form>
";

?>