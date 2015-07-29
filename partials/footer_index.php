<script src="<?= WEBROOT; ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?= WEBROOT; ?>/js/bootstrap.min.js"></script>
<script src="<?= WEBROOT; ?>/js/bootstrap-table.js"></script>
<script src="<?= WEBROOT; ?>/js/script_visiteurs.js"></script>
<script src="<?= WEBROOT; ?>/js/script_visites.js"></script>
<script src="<?= WEBROOT; ?>/js/script_matrice.js"></script>
<script src="<?= WEBROOT; ?>/js/script.js"></script>
<script src="<?= WEBROOT; ?>/js/script_js.js"></script>
<script src="<?= WEBROOT; ?>/js/formValidation.js"></script>
<script src="<?= WEBROOT; ?>/js/framework/bootstrap.js"></script>
<script src="<?= WEBROOT; ?>/js/bootstrap-datepicker.min.js"></script>
<script src="<?= WEBROOT; ?>/js/bootstrap-formhelpers.js"></script>
<script src="<?= WEBROOT; ?>/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width : 443,
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
    
$(document).ready(function() {
    $('#affaireForm').formValidation({
        framework: 'bootstrap',
        fields: {
            inputNumero: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    },
                    numeric: {
                        message: 'Nombre obligatoire'
                    },
                    stringLength: {
                        min: 5,
                        max: 5,
                        message: 'Le nombre doit contenir 5 chiffres'
                    }
                }
            },
            inputNom: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            inputClient: {
                validators: {
                    notEmpty: {
                        message: 'Ce champs est requis'
                    }
                }
            },
            salarie: {
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
