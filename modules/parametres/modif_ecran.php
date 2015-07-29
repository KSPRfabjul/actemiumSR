<?php

include '../../lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $_POST['id'];

$req = "SELECT * FROM accueil WHERE id=$id";
$select = $db->query($req);
$message = $select->fetch();

echo "
    <link href=\"../../css/datepicker.min.css\" rel=\"stylesheet\" />
    <link href=\"../../css/datepicker3.min.css\" rel=\"stylesheet\" />

    <script src=\"../../js/framework/bootstrap.js\"></script>
    <script src=\"../../js/bootstrap-datepicker.min.js\"></script>
    <script src=\"../../js/tinymce/tinymce.min.js\"></script>

    <script type=\"text/javascript\">
        tinymce.init({
            selector: \"textarea\",
            theme: \"modern\",
            width : 443,
            plugins: [
                \"emoticons template paste textcolor colorpicker textpattern\"
            ],
            toolbar1: \"insertfile undo redo | bold italic | forecolor backcolor emoticons\",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
    </script>

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

    <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
        <div class=\"form-group\">
            <label for=\"datePicker2\" class=\"col-sm-2 control-label\">Date</label>
            <div class=\"col-sm-10\">
                <div class=\"input-group input-append date\" id=\"datePicker2\">
                    <input type=\"text\" class=\"form-control\" name=\"date\" id=\"date\" value=\"".$message['date']."\"/>
                    <span class=\"input-group-addon add-on\"><span class=\"glyphicon glyphicon-calendar\"></span></span>
                </div>
            </div>
        </div>
        <div class=\"form-group\">
            <label for=\"message\" class=\"col-sm-2 control-label\">Message</label>
            <div class=\"col-sm-10\">
                <textarea name=\"inputTexte\" id=\"text-ecran\">".$message['value']."</textarea>
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
            </div>
        </div>
        <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
        <input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"update\">
    </form>
";

?>