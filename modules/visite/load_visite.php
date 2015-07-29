<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $db->quote($_POST['id']);

$req = "SELECT DATE_FORMAT(date, '%d-%m-%Y') AS date, D.id as id, UPPER(nom) AS nom, prenom, UPPER(entreprise) AS entreprise, raison, mail, telephone FROM date D, visiteur V WHERE D.id_visiteur=V.id AND D.id=$id";
$select = $db->query($req);
$visite = $select->fetch();


echo "

<legend class=\"scheduler-border\">" . $visite['date'] . "</legend>

<table class=\"table table-hover table-striped\" id=\"tableVisites\">
    <tbody>
        <tr>
            <td>Nom</td><td><strong>" . $visite['nom'] . ' ' . $visite['prenom'] ."</stong></td>
        </tr>
        <tr>
            <td>Société</td><td>" . $visite['entreprise'] . "</td>
        </tr>
        <tr>
            <td>Téléphone</td><td>" . $visite['telephone'] . "</td>
        </tr>
        <tr>
            <td>Mail</td><td><a href=\"mailto:" . $visite['mail'] . "\">" . $visite['mail'] . "</a></td>
        </tr>
        <tr>
            <td>Raison</td><td>" . $visite['raison'] . "</td>
        </tr>
    </tbody>
</table>
";

?>