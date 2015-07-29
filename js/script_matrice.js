$(document).ready(function(){
    
    $("#selectTriMatrice").change(function(){

        var t = encodeURIComponent( $("#selectTriMatrice").val() );
        var s = encodeURIComponent( $("#selectTriSousMatrice").val() );

        var data = {
            "tri_categorie": t,
            "tri_sous_categorie": s
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../documents/tri_matrice.php",
            data: data,
            success: function(data) {
                $("#tableFichiers tbody tr").remove();
                $.each(data.fichiers, function(idx, fichier){
                    $("#tableFichiers").append("<tr><td>" + fichier.id + "</td><td>" + fichier.nom + fichier.extension + "</td><td>" + fichier.categorie + "</td><td>" + fichier.sous_categorie + "</td><td>" + fichier.date + "</td><td>" + fichier.version + "</td><<td><button type=\"button\" class=\"btn btn-primary LienModalMatrice\" id=\"LienModalMatrice\" data-toggle=\"modal\" data-target=\"#modalModif\" rel=\"" + fichier.id + "\">Modifier</button> <a href=\"?delete=" + fichier.id +"\" class=\"btn btn-default\" onclick=\"return confirm('Sur de sur ?');\">Supprimer</a> <a href=\"?download=" + fichier.id + "\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i></a></td></tr>");
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });
    
    $("#selectTriSousMatrice").change(function(){

        var t = encodeURIComponent( $("#selectTriMatrice").val() );
        var s = encodeURIComponent( $("#selectTriSousMatrice").val() );

        var data = {
            "tri_categorie": t,
            "tri_sous_categorie": s
        };

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../documents/tri_matrice.php",
            data: data,
            success: function(data) {
                $("#tableFichiers tbody tr").remove();
                $.each(data.fichiers, function(idx, fichier){
                    $("#tableFichiers").append("<tr><td>" + fichier.id + "</td><td>" + fichier.nom + fichier.extension + "</td><td>" + fichier.categorie + "</td><td>" + fichier.sous_categorie + "</td><td>" + fichier.date + "</td><td>" + fichier.version + "</td><<td><button type=\"button\" class=\"btn btn-primary LienModalMatrice\" id=\"LienModalMatrice\" data-toggle=\"modal\" data-target=\"#modalModif\" rel=\"" + fichier.id + "\">Modifier</button> <a href=\"?delete=" + fichier.id +"\" class=\"btn btn-default\" onclick=\"return confirm('Sur de sur ?');\">Supprimer</a> <a href=\"?download=" + fichier.id + "\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i></a></td></tr>");
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR : " + textStatus);
            }
        });
    });

});