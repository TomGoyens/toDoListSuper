<?php

try{
  $conn = new mysqli("localhost", "veryCoolUser", "unGuessable1010", "toDo");
  // echo 'Connection successfull';
}catch(Exception $exception){
  die('Connection failed');
}

$stmt = $conn->prepare("SELECT * FROM toDoApp");
$stmt->execute();
$result = $stmt->get_result();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="assets/css/main.css" rel="stylesheet" type='text/css' />
    <title>eyyyy</title>
  </head>
  <body>
    <div class="toDoApp">
      <div class="toDoHeader">
        <h2>To do, to do, Pikachu</h2>
        <div class="formToDo">
          <input type="text" name="addToDo" value="Do something" class="inputToDo"/>
          <span class="addToDoBtn"> Add </span>
        </div>
        <ul class="toDoList">
          <?php while($row = $result->fetch_assoc()){ ?>
              <li class="toDoListItem <?php  echo $row['Id']; ?> <?php if ($row['done'] == 1){ echo 'checked'; } ?>"><?php echo $row['item']; ?><span> × </span></li>
          <?php } ?>
        </ul>
      </div>
    </div>

  <script src="assets/js/main_script.js" type="text/javascript"></script>
  </body>
</html>
