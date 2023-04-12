<?php

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
function latest($conn,$table)
{
  $stmt = $conn->prepare("SELECT * FROM $table ORDER BY id DESC LIMIT 5");
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


// function get Total
function Total($conn,$table)
{
    $stmt = $conn->prepare("SELECT * FROM $table ");
    $stmt->execute();
    $total = $stmt->rowCount();
    return $total;
}

 ?>
