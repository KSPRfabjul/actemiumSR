<?php

include '../../lib/includes.php';

/**
 * SELECTION DU VISITEUR CORRESPONDANT A L'ID
 */

$id = $db->quote($_POST['id']);

$req = "SELECT UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, mail, telephone FROM visiteur V WHERE V.id=$id";
$select = $db->query($req);
$visiteur = $select->fetch();


/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, raison FROM date D WHERE D.id_visiteur=$id";
$select = $db->query($req);
$visites = $select->fetchALl();


echo "
<table class=\"table table-hover table-striped\" id=\"tableVisites\">
    <tbody>
        <tr>
            <td>Nom</td><td><strong>" . $visiteur['nom'] . ' ' . $visiteur['prenom'] ."</stong></td>
        </tr>
        <tr>
            <td>Société</td><td>" . $visiteur['entreprise'] . "</td>
        </tr>
        <tr>
            <td>Téléphone</td><td>" . $visiteur['telephone'] . "</td>
        </tr>
        <tr>
            <td>Mail</td><td><a href=\"mailto:" . $visiteur['mail'] . "\">" . $visiteur['mail'] . "</a></td>
        </tr>
    </tbody>
</table>

<legend class=\"scheduler-border\">Liste des visites</legend>

<table class=\"table table-hover table-striped\" id=\"tableVisites\">
	<thead>
		<th>Date</th>
		<th>Raison</th>
	</thead>
    <tbody>";
    	foreach($visites as $visite):
    	
    	echo"<tr>
    			<td>" . $visite['date'] . "</td><td>" . $visite['raison'] . "</td>
    		</tr>";
    	
    	endforeach;
    echo "</tbody>
</table>
";

?>