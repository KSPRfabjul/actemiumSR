<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/datepicker.css" />
    <link rel="stylesheet" href="../css/style_ecran.css" />

    <!-- script references -->
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width : 500,
        plugins: [
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | bold italic | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });
    </script>

    <title>Ecran d'accueil</title>

</head>

<body>

<?php
	session_start();
	flash();
?>