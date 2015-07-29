<?php

include './lib/includes.php';

if($_SESSION['Auth']['id_status'] == '1'){
    header('Location:' . WEBROOT . 'index_normal.php');
} elseif($_SESSION['Auth']['id_status'] == '2'){
    header('Location:' . WEBROOT . 'index_admin.php');
} elseif($_SESSION['Auth']['id_status'] == '3'){
    header('Location:' . WEBROOT . 'index_essais.php');
} elseif($_SESSION['Auth']['id_status'] == '4'){
    header('Location:' . WEBROOT . 'index_magasin.php');
}

?>