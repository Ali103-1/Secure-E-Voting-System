<?php
// هذه هو ملف الرئيسي في الموقع يحتوى على كل ملفات و يقوم بربط بين جميع الملفات
    include 'connect.php';

    $tpl = '../includes/templates/';
    $css = '../layout/css/';
    $js = '../layout/js/';
    $func = '../includes/functions/';
    $avatar = '../downloads/avatars/';
    $images = '../downloads/images/';
    $logo = '../downloads/logo/';

    $avatars = '../downloads/avatars/';
    $icons = '../downloads/icons/';

    include $func . 'functions.php';
    include $tpl . 'header.php';
    if (!isset($noNavbar))
    {
      include $tpl . 'navbar.php';
    }
    if (isset($noNavbar))
    {
      include $tpl . 'navbar2.php';
    }
    if (isset($noNavbar2))
    {
      include $tpl . 'navbar.php';
    }
 ?>
