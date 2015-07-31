$(document).ready(function(){

    $('#duplicatebtn').click(function(e){
		e.preventDefault();
        var $clone = $('#duplicate').clone().attr('id', 'addcat').removeClass('hidden');
        $('#duplicate').before($clone);
    });

    $("#dispo").change(function(){

        var p = encodeURIComponent( $("#dispo").val() );

        var data = {
            "dispo": p
        };

        $.ajax({
            type: "POST",
            dataType: "text",
            url: "./lib/update_dispo.php",
            data: data,
            success: function(data) {
                if(data == ''){
                    console.log("Retour : vide");
                }else{
                    location.reload();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });

    $('#formEmprunt').formValidation({
        message: 'Cette valeur est invalide',
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            identifiant: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            equipement: {
                validators: {
                    notEmpty: {
                        message: 'Veuillez choisir un élément'
                    }
                }
            }
        }
    });

    $('#datePicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(document).on('click', '.LienModalDetailVisite', function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"load_visite.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    $(document).on('click', '.LienModalDetailVisiteur', function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"load_visiteur.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    $(document).on('click', '.LienModalVisite', function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_visite.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    $(".LienModalEcran").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_ecran.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    $(".LienModalSalarie").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_personnel.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    $(".LienModalNews").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBodyNews").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_news.php",
            error:function(msg){
                $(".modalBodyNews").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                console.log(data);
                $(".modalBodyNews").fadeIn(1000).html(data);
            }
        });
    });
    
    $(".LienModalAffaire").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_affaire.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });
        
    $(".LienModalCategorie").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_categorie.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });
        
    $(".LienModalSousCategorie").click(function(){

        console.log("Modal : " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_sscategorie.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    }); 

    
    $(document).on('click', '.LienModalMatrice', function(){

        console.log("Modal bis: " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_fichiers_matrice.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    
    $(document).on('click', '.LienModalDoc', function(){

        console.log("Modal bis: " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_fichiers_doc.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });

    
    $(document).on('click', '.LienNomenclature', function(){

        console.log("Modal bis: " + $(this).attr("rel"));

        var id = $(this).attr("rel");
        $(".modalBody").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"POST",
            data:{id : id},
            url:"modif_nomenclature.php",
            error:function(msg){
                $(".modalBody").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modalBody").fadeIn(1000).html(data);
            }
        });
    });
    
    $(document).on('keyup', '#searchNomFichier', function(){

		var n = encodeURIComponent( $('#searchNomFichier').val() );
        var r = encodeURIComponent( $('#searchRef').val() );
        var f = encodeURIComponent( $('#searchFabricant').val() );
         
        var data = {
            "nom": n,
            "ref": r,
            "fabricant": f
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "search_fichiers.php",
            data: data,
            success: function(data) {
                console.log(data);
                
				$("#tableFichierTech tbody tr").remove();

                $.each(data.fichiers, function(idx, fichier){
                    $("#tableFichierTech").append("<tr><td>" + fichier.id + "</td><td>" + fichier.nom + fichier.extension + "</td><td>" + fichier.nom_produit + "</td><td>" + fichier.ref + "</td><td>" + fichier.fabricant + "</td><td>" + fichier.date + "</td><td><button type=\"button\" class=\"btn btn-primary LienModalDoc\" id=\"LienModalDoc\" data-toggle=\"modal\" data-target=\"#modalModif\" rel=\"" + fichier.id + "\">Modifier</button> <a href=\"?delete=" + fichier.id + "\" class=\"btn btn-default\" onclick=\"return confirm('Sur de sur ?');\">Supprimer</a> <a href=\"?download=" + fichier.id + "\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i></a></td></tr>");
                });


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });
    
    $(document).on('keyup', '#searchRef', function(){

		var n = encodeURIComponent( $('#searchNomFichier').val() );
        var r = encodeURIComponent( $('#searchRef').val() );
        var f = encodeURIComponent( $('#searchFabricant').val() );
         
        var data = {
            "nom": n,
            "ref": r,
            "fabricant": f
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "search_fichiers.php",
            data: data,
            success: function(data) {
                console.log(data);
                
				$("#tableFichierTech tbody tr").remove();
				
                $.each(data.fichiers, function(idx, fichier){
                    $("#tableFichierTech").append("<tr><td>" + fichier.id + "</td><td>" + fichier.nom + fichier.extension + "</td><td>" + fichier.nom_produit + "</td><td>" + fichier.ref + "</td><td>" + fichier.fabricant + "</td><td>" + fichier.date + "</td><td><button type=\"button\" class=\"btn btn-primary LienModalDoc\" id=\"LienModalDoc\" data-toggle=\"modal\" data-target=\"#modalModif\" rel=\"" + fichier.id + "\">Modifier</button> <a href=\"?delete=" + fichier.id + "\" class=\"btn btn-default\" onclick=\"return confirm('Sur de sur ?');\">Supprimer</a> <a href=\"?download=" + fichier.id + "\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i></a></td></tr>");
                });

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });
    
    $(document).on('keyup', '#searchFabricant', function(){

		var n = encodeURIComponent( $('#searchNomFichier').val() );
        var r = encodeURIComponent( $('#searchRef').val() );
        var f = encodeURIComponent( $('#searchFabricant').val() );
         
        var data = {
            "nom": n,
            "ref": r,
            "fabricant": f
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "search_fichiers.php",
            data: data,
            success: function(data) {
                console.log(data);
                
				$("#tableFichierTech tbody tr").remove();

                $.each(data.fichiers, function(idx, fichier){
                    $("#tableFichierTech").append("<tr><td>" + fichier.id + "</td><td>" + fichier.nom + fichier.extension + "</td><td>" + fichier.nom_produit + "</td><td>" + fichier.ref + "</td><td>" + fichier.fabricant + "</td><td>" + fichier.date + "</td><td><button type=\"button\" class=\"btn btn-primary LienModalDoc\" id=\"LienModalDoc\" data-toggle=\"modal\" data-target=\"#modalModif\" rel=\"" + fichier.id + "\">Modifier</button> <a href=\"?delete=" + fichier.id + "\" class=\"btn btn-default\" onclick=\"return confirm('Sur de sur ?');\">Supprimer</a> <a href=\"?download=" + fichier.id + "\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i></a></td></tr>");
                });


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });

});