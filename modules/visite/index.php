<?php

$auth = 0;
/**
* GENERAL INCLUDES
**/
include '../../lib/includes.php';


/**
* AJOUT DES VISITEURS DANS LA BASE
**/
if(isset($_POST['nom']) && isset($_POST['prenom'])){

	$nom = $db->quote($_POST['nom']);
	$prenom = $db->quote($_POST['prenom']);
	$entreprise = $db->quote($_POST['entreprise']);
	$mail = $db->quote($_POST['mail']);
	$telephone = $db->quote($_POST['telephone']);
	$raison = $db->quote($_POST['raison']);
	$lastId = '';

	$select = $db->query("SELECT * FROM visiteur WHERE nom=$nom AND prenom=$prenom and entreprise=$entreprise");
	if($select->rowCount() == 0){
	    $db->query("INSERT INTO visiteur SET nom=$nom, prenom=$prenom, entreprise=$entreprise, mail=$mail, telephone=$telephone");
	    $lastId = $db->lastInsertId();
	} else {
		$_POST = $select->fetch();
		$lastId = $_POST['id'];
	}

	$lastId = $db->quote($lastId);
	$date = $db->quote(date("Y-m-d"));

	$db->query("INSERT INTO date SET date=$date, id_visiteur=$lastId, raison=$raison");

	echo "<div class='alert alert-success'>Enregistrement effectué</div>";
	header("refresh:3; url=./index.php");

}

include '../../partials/header_visiteur.php';

?>

<div class="container">
    <div class="row">

    	<div class="row">
	    	<div class="col-lg-5">
	    		<img src="../../img/logo.jpg" class="img-responsive" alt="logo">
	    	</div>
    	</div>

        <!-- form: -->
        <section>
            <div class="page-header">
                <h1>Formulaire visiteur</h1>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <form id="visitForm" method="post" action="#" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Nom</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="nom" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Prenom</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="prenom" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Entreprise</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="entreprise" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mail</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="mail" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Téléphone</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="telephone" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Raison visite</label>
                            <div class="col-lg-5">
                                <textarea class="form-control" name="raison" rows="3"></textarea>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- :form -->
    </div>
</div>

<!-- script references -->
<script src="../../js/jquery-2.1.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/formValidation.js"></script>
<script type="text/javascript" src="../../js/framework/bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#visitForm').formValidation({
        message: 'Cette valeur est invalide',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nom: {
            	validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            prenom: {
            	validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            entreprise: {
            	validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            mail: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    },
                    emailAddress: {
                        message: 'L\'adresse mail indiquée n\'est pas valide'
                    }
                }
            },
            telephone: {
            	validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    },
            		phone: {
            			message: 'La valeur n\'est pas un numéro de téléphone valide',
            			country: 'FR'
            		}
            	}
            },
            raison: {
            	validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            }
        }
    });
});
</script>

</body>
</html>