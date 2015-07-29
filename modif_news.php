<?php

include './lib/includes.php';

/**
 * SELECTION DE LA VISITE CORRESPONDANT A L'ID
 */

$id = $_POST['id'];

$req = "SELECT * FROM news WHERE id=$id";

$select = $db->query($req);
$news = $select->fetch();

echo "
    <script src=\"./js/tinymce/tinymce.min.js\"></script>
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

    <form class=\"form-horizontal\" method=\"POST\" action=\"#\">
        <div class=\"form-group\">
            <label for=\"inputMessageNews\" class=\"col-sm-2 control-label\">Message</label>
            <div class=\"col-sm-10\">
                <textarea class=\"form-control\" rows=\"6\" id=\"inputMessageNews\" name=\"inputMessageNews\">".$news['message']."</textarea>
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"col-sm-offset-2 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-primary\">Envoyer</button>
            </div>
        </div>
        <input type=\"hidden\" name=\"inputId\" value=\"".$id."\">
        <input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"update-news\">
    </form>
";

?>