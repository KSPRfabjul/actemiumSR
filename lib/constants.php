<?php
define('WWW_ROOT', dirname(dirname(__FILE__)));

$directory = basename(WWW_ROOT);
$url = explode($directory, $_SERVER['REQUEST_URI']);
if(count($url) == 1){
    define('WEBROOT', '/');
}else{
    define('WEBROOT', $url[0] . 'actemiumSR/');
}

define('IMAGES', WWW_ROOT . DIRECTORY_SEPARATOR . 'img');

define ('SERVER', '/Users/Julien/Documents/Corail/Application/Serveur/BE/FICHIERS/');
define ('SERVER_SRC', '/Users/Julien/Documents/Corail/Application/Serveur/BE/FICHIERS/_DEFAULT_');

define ('SRC_MATRICE','/Users/Julien/Documents/Corail/Application/Serveur/MATRICE/');

define ('SRC_USB', '/Volumes/');

define('SRC_DOC','/Users/Julien/Documents/Corail/Application/Serveur/BE/DOC TECHNIQUES');

