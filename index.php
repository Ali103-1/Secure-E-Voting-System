<?php
session_start();

$pageTitle = "الصفحة الرئيسية";
include 'init.php';
// هذه صفحة تقوم بعمل تحويل الى صفحة الرئيسية للموقع

header('location: en/index.php');
?>

<?php
include $tpl . 'footer.php';
?>
