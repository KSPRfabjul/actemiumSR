$(document).ready(function(){

    $(document).on('keyup', '#searchNom', function(){

		var n = encodeURIComponent( $('#searchNom').val() );
        var e = encodeURIComponent( $('#searchEntreprise').val() );
        var data = {
            "nom": n,
            "entreprise": e
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../../lib/search_visiteurs.php",
            data: data,
            success: function(data) {
                console.log(JSON.stringify(data.visiteurs));
                $("#tableVisiteurs tbody tr").remove();
                $.each(data.visiteurs, function(idx, visiteur){
                    $("#tableVisiteurs").append("<tr><td>" + visiteur.nom + " " + visiteur.prenom + "</td><td>" + visiteur.entreprise + "</td><td>" + visiteur.mail + "</td><td>" + visiteur.telephone + "</td><td><button type=\"button\" class=\"btn btn-default btn-sm LienModalDetailVisiteur\" id=\"#LienModalDetailVisiteur\" data-toggle=\"modal\" data-target=\"#modalVisiteur\" rel=\"" + visiteur.id + "\">Plus d'info.</button></td></tr>");
                    console.log("NOM : " + visiteur.nom + " ENTREPRISE : " + visiteur.entreprise);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });

    $(document).on('keyup', '#searchEntreprise', function(){

        var n = encodeURIComponent( $('#searchNom').val() );
        var e = encodeURIComponent( $('#searchEntreprise').val() );
        var data = {
            "nom": n,
            "entreprise": e
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../../lib/search_visiteurs.php",
            data: data,
            success: function(data) {
                console.log(JSON.stringify(data.visiteurs));
                $("#tableVisiteurs tbody tr").remove();
                $.each(data.visiteurs, function(idx, visiteur){
                    $("#tableVisiteurs").append("<tr><td>" + visiteur.nom + " " + visiteur.prenom + "</td><td>" + visiteur.entreprise + "</td><td>" + visiteur.mail + "</td><td>" + visiteur.telephone + "</td><td><button type=\"button\" class=\"btn btn-default btn-sm LienModalDetailVisiteur\" id=\"#LienModalDetailVisiteur\" data-toggle=\"modal\" data-target=\"#modalVisiteur\" rel=\"" + visiteur.id + "\">Plus d'info.</button></td></tr>");
                    console.log("NOM : " + visiteur.nom + " ENTREPRISE : " + visiteur.entreprise);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });
});