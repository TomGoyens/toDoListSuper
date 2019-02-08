<?php
try{
  $conn = new mysqli("localhost", "veryCoolUser", "unGuessable", "toDo");
  // echo 'Connection successfull';
}catch(Exception $exception){
  die('Connection failed');
}
?>
