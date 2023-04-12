<?php

// ملف رئيسي في الموقع الذي يربط بين جميع ملفات الموجودة ويتم وضعه لنتفادي تكرار الملفات
    include 'connect.php';

    $tpl = 'includes/templates/';
    $css = 'layout/css/';
    $js = 'layout/js/';
    $func = 'includes/functions/';
    $avatar = '../downloads/avatars/';
    $images = '../downloads/images/';
    $logo = '../downloads/logo/';
    $cv = '../downloads/cv/';

    include $func . 'functions.php';

    include $tpl . 'header.php';
    if (!isset($noNavbar))
    {
      include $tpl . 'navbar.php';
    }

 ?>
