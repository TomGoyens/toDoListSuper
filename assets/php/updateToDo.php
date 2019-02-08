<?php
try{
  $conn = new mysqli("localhost", "veryCoolUser", "unGuessable1010", "toDo");
  // echo 'Connection successfull';
}catch(Exception $exception){
  die('Connection failed');
}

$stmt = $conn->prepare("ALTER TABLE toDoApp AUTO_INCREMENT=1");
$stmt->execute();

$item = isset($_GET['update']) ? htmlentities($_GET['update']) : 'default';

if ($item != 'default'){
  $stmt = $conn->prepare("INSERT INTO toDoApp (item, done)
  VALUES (?, 0)");
  $stmt->bind_param("s", $item);
  if ($stmt->execute()) {
    echo 'yes';
  } else{
    echo 'no';
  }
}

$removeItem =isset($_GET['remove']) ? htmlentities($_GET['remove']) : 'default';
if ($removeItem != 'default'){
  $stmt = $conn->prepare("
  DELETE FROM toDoApp
  WHERE Id= ?;
  ");
  $stmt->bind_param("i", $removeItem);
  if ($stmt->execute()) {
    echo 'yes';
  } else{
    echo 'no';
  }
}

$checkItem =isset($_GET['checkItem']) ? htmlentities($_GET['checkItem']) : 'default';
if ($checkItem != 'default'){
  $stmt = $conn->prepare("UPDATE toDoApp SET done = 1 WHERE Id= ? ;");
  $stmt->bind_param("i", $checkItem);
  if ($stmt->execute()) {
    echo 'yes';
  } else{
    echo 'no';
  }
}

$uncheckItem =isset($_GET['uncheckItem']) ? htmlentities($_GET['uncheckItem']) : 'default';
if ($uncheckItem != 'default'){
  $stmt = $conn->prepare("UPDATE toDoApp SET done = 0 WHERE Id= ? ;");
  $stmt->bind_param("i", $uncheckItem);
  if ($stmt->execute()) {
    echo 'yes';
  } else{
    echo 'no';
  }
}

$getId = isset($_GET['getId']) ? htmlentities($_GET['getId']) : 'default';
if ($getId != 'default'){
  $stmt = "SELECT MAX(Id) FROM toDoApp;";
  $result = $conn->query($stmt);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['MAX(Id)'];
  } else{
    echo 'no';
  }
}

 ?>
