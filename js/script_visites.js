$(document).ready(function(){

    $("#selectTri").change(function(){

        var t = encodeURIComponent( $("#selectTri").val() );
        var o = encodeURIComponent( $("#selectOrdre").val() );

        var data = {
            "tri": t,
            "ordre" : o
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../../lib/search_visites.php",
            data: data,
            success: function(data) {
                $("#tableVisites tbody tr").remove();
                $.each(data.visites, function(idx, visite){
                    $("#tableVisites").append("<tr><td>" + visite.id + "</td><td>" + visite.date + "</td><td>" + visite.nom + " " + visite.prenom + "</td><td>" + visite.entreprise + "</td><td>" + visite.raison + "</td><td><a href=\"?info=" + visite.id + "\" class=\"btn btn-default btn-sm\"\">Plus d'info.</a></td></tr>");
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });

    $("#selectOrdre").change(function(){

        var t = encodeURIComponent( $("#selectTri").val() );
        var o = encodeURIComponent( $("#selectOrdre").val() );

        var data = {
            "tri": t,
            "ordre" : o
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../../lib/search_visites.php",
            data: data,
            success: function(data) {
                $("#tableVisites tbody tr").remove();
                $.each(data.visites, function(idx, visite){
                    $("#tableVisites").append("<tr><td>" + visite.id + "</td><td>" + visite.date + "</td><td>" + visite.nom + " " + visite.prenom + "</td><td>" + visite.entreprise + "</td><td>" + visite.raison + "</td><td><a href=\"?info=" + visite.id + "\" class=\"btn btn-default btn-sm\"\">Plus d'info.</a></td></tr>");
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });
});