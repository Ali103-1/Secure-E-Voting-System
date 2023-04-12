<?php
session_start();

  include 'init.php';

// صفحة خاصة بادخال التصويت

// هنا خاصية تقوم بجلب بيانات الحاسوب الذي قام بالتتصويت ويتم تسجيل التصويت عبر بيانات الحاسوب
  $user = $_SERVER['HTTP_USER_AGENT'];


  $election = $_POST['election'];
  $condidate = $_POST['condidate'];

// هنا نقوم بادخال تصويت جديد
  $stmt = $conn->prepare("INSERT INTO vote(user,election,condidate,created)
   VALUES(:zf,:ze,:zcon,now())");
  $stmt->execute(array(
    'zf' => $user,
    'ze' => $election,
    'zcon' => $condidate



  ));

// هنا نقوم بجلب عدد الاصوات للمنتخب
  $stmt = $conn->prepare("SELECT * FROM election  WHERE id = ?");
  $stmt->execute(array($election));
  $data = $stmt->fetch();


// هنا نضيف تصويت الى مجموع الاصوات
  $total = $data['total_votes'] + 1;

  $stmt = $conn->prepare("UPDATE election SET total_votes = ? WHERE id = ?");
  $stmt->execute(array($total,$election));





  // هنا نقوم بجلب عدد الاصوات للمنتخب
    $stmt = $conn->prepare("SELECT * FROM condidate  WHERE id = ?");
    $stmt->execute(array($condidate));
    $data2 = $stmt->fetch();


  // هنا نضيف تصويت الى مجموع الاصوات
    $total2 = $data2['total_votes'] + 1;

    $stmt = $conn->prepare("UPDATE condidate SET total_votes = ? WHERE id = ?");
    $stmt->execute(array($total2,$condidate));
 ?>
