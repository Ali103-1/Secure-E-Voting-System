<?php

// هذه ملف خاصة بتسجيل الخروج من خلال تدمير سيشن في الموقع وتحويله الى صفحة الدخول
      session_start();
      session_unset();
      session_destroy();

      header('location: index.php');

      exit();


 ?>
