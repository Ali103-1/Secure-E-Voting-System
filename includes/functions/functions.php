<?php
// هنا ملف خاص بالفونكشن يمكنك استعمال اي فونكشن من هذه
  // function get Title
function getTitle()
{
  global $pageTitle;

  if (isset($pageTitle))
  {
    echo $pageTitle;
  }else {
    $pageTitle = 'Default page';
  }
}

// function latest
function latest($conn,$table,$nbr)
{
  $stmt = $conn->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT $nbr");
  $stmt->execute();
  $lt = $stmt->fetchAll();
  return $lt;
}
function latestPro($conn,$table,$nbr)
{
  $stmt = $conn->prepare("SELECT * FROM $table WHERE status = 1 ORDER BY id DESC LIMIT $nbr");
  $stmt->execute();
  $lt = $stmt->fetchAll();
  return $lt;
}
// function get all items
function AllItems($conn,$table,$ord)
{
    $stmt = $conn->prepare("SELECT * FROM $table ORDER BY id $ord");
    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
}
// function get all items
function sAllItems($conn,$table,$conf)
{
    $stmt = $conn->prepare("SELECT * FROM $table ORDER BY $conf");
    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
}


// function get Total
function Total($conn,$table)
{
    $stmt = $conn->prepare("SELECT * FROM $table ");
    $stmt->execute();
    $total = $stmt->rowCount();
    return $total;
}

 ?>
