<?php

function get_connection(){
  $dsn = "mysql:host=localhost;dbname=wftutorials";
  $user = "root";
  $passwd = "";
  $conn = new PDO($dsn, $user, $passwd);
  return $conn;
}

function save_task($type, $task, $id){
  $conn = get_connection();
  if($id){
    $sql = "UPDATE kaban_board SET `task`=? WHERE id=?"; // create sql
    $query = $conn->prepare($sql); // prepare
    $query->execute([$task, $id]); // execute
    return $id;
  }else{
    $sql = "INSERT INTO kaban_board(`task`,`type`) VALUES (?,?)"; // create sql
    $query = $conn->prepare($sql); // prepare
    $query->execute([$task,$type]); // execute
    return $conn->lastInsertId();
  }
}

function move_task($id, $position){
  $conn = get_connection();
  $sql = "UPDATE kaban_board SET `type`=? WHERE id=?"; // create sql
  $query = $conn->prepare($sql); // prepare
  $query->execute([$position,$id]); // execute
}

function get_tasks($type){
  $results = [];
  try {
    $conn = get_connection();
    $query = $conn->prepare("SELECT * from kaban_board WHERE type=? order by id desc");
    $query->execute([$type]);
    $results = $query->fetchAll();
  }catch (Exception $e){

  }
  return $results;
}

function get_task($id){
  $results = [];
  try {
    $conn = get_connection();
    $query = $conn->prepare("SELECT * from kaban_board WHERE id=?");
    $query->execute([$id]);
    $results = $query->fetchAll();
    $results = $results[0];
  }catch (Exception $e){

  }
  return $results;
}


function show_tile($taskObject, $type=""){
  $baseUrl = $_SERVER["PHP_SELF"]."?shift&id=".$taskObject["id"]."&type=";
  $editUrl = $_SERVER["PHP_SELF"] . "?edit&id=".$taskObject["id"]."&type=". $type;
  $deleteUrl = $_SERVER["PHP_SELF"] . "?delete&id=".$taskObject["id"];
  $o = '<span class="board">'.$taskObject["task"].'
      <hr>
      <span>
        <a href="'.$baseUrl.'backlog">B</a> |
        <a href="'.$baseUrl.'pending">P</a> |
        <a href="'.$baseUrl.'progress">IP</a> |
        <a href="'.$baseUrl.'completed">C</a> |
      </span>
      <a href="'.$editUrl.'">Edit</a> | <a href="'.$deleteUrl.'">Delete</a>
      </span>';
  return $o;
}

function get_active_value($type, $content){
  $currentType = isset($_GET['type']) ? $_GET['type']:  null;
  if($currentType == $type){
    return $content;
  }
  return "";
}


$activeId = "";
$activeTask = "";


if(isset($_GET['shift'])){
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  $type = isset($_GET['type']) ? $_GET['type'] : null;
  if($id){
    move_task($id, $type);
    header("Location: ". $_SERVER['PHP_SELF']);
    exit();
  }else{
    // redirect take no action.
    header("Location: ". $_SERVER['PHP_SELF']);
  }
}

if(isset($_GET['edit'])){
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  $activeId = $id;
  $type = isset($_GET['type']) ? $_GET['type'] : null;
  if($id){
    $taskObject = get_task($id);
    $activeTask = $taskObject["task"];
  }
}

if(isset($_GET['delete'])){
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  if($id){
    try {
      $conn = get_connection();
      $query = $conn->prepare("DELETE from kaban_board WHERE id=?");
      $query->execute([$id]);
      header("Location: ". $_SERVER['PHP_SELF']);
    }catch (Exception $e){

    }
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $backlog = "";
  $pending = "";
  $progress = "";
  $completed = "";
  $taskId = isset($_POST['task']) ? $_POST['task'] : null;

  if(isset($_POST['save-backlog'])){
    $backlog = isset($_POST['backlog']) ? $_POST['backlog'] : null;
    save_task('backlog', $backlog, $activeId);

  }else if(isset($_POST['save-pending'])){
    $pending = isset($_POST['pending']) ? $_POST['pending'] : null;
    save_task('pending', $pending, $activeId);
  }else if(isset($_POST['save-progress'])){
    $progress = isset($_POST['progress']) ? $_POST['progress'] : null;
    save_task('progress', $progress, $activeId);
  }else if(isset($_POST['save-completed'])){
    $completed = isset($_POST['completed']) ? $_POST['completed'] : null;
    save_task('completed', $completed, $activeId);
  }
  if($activeId){
    header("Location: ". $_SERVER['PHP_SELF']);
  }

}

?>