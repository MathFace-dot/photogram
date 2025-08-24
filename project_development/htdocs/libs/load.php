<?php

include_once 'includes/Database.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Session.class.php';
include_once 'includes/UserSession.class.php';
include_once 'includes/WebAPI.class.php';

Session::start();

global $__site_config;
// global $__base_path;/var/www/html/htdocs_photo/htdocs/libs/load.php
///var/www/html/htdocs_photo/project/scss
//Note: Change this path if you run this code outside lab.
$__site_config = __DIR_.'../../../project/photogramconfig.json';
// $__base_path = get_config('base_path');
Session::start();
//print($__site_config);

function get_config($key, $default=null)
{
    global $__site_config;
    $array = json_decode($__site_config, true);
    //print_r($array);
    if (isset($array[$key])) {
        return $array[$key];
    } else {
        return $default;
    }
}



function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/htdocs/photogram/_templates/$name.php"; //not consistant.
}






?>
