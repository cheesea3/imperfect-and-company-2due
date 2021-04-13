<?php

    if (!$GLOBALS['url_loc'][2]) {
        //Check to see if user is logged in, if so... load his profile otherwise ask user to provide a profile
        if (User::isLoggedIn()) {
      header("location: ./home");
        } else {
      header("location: ./");
        }
    }
	else {
//gets board name
if(User::getBoardName($GLOBALS['url_loc'][2])){
$boardName = User::getBoardName($GLOBALS['url_loc'][2]);
$todo = DatabaseConnector::query('SELECT * FROM board_items WHERE board_ID=:boardid AND board_column = "0"', array(':boardid'=>$GLOBALS['url_loc'][2]));
$doing = DatabaseConnector::query('SELECT * FROM board_items WHERE board_ID=:boardid AND board_column = "1"', array(':boardid'=>$GLOBALS['url_loc'][2]));
$done = DatabaseConnector::query('SELECT * FROM board_items WHERE board_ID=:boardid AND board_column = "2"', array(':boardid'=>$GLOBALS['url_loc'][2]));

$boardid = $GLOBALS['url_loc'][2];
$userid = User::isLoggedIn();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
		if(isset($_POST['move'])){  
		$taskId = $_POST['move'];  
		$taskCol = $_POST['taskcol'];  
		User::moveTask($taskId, $taskCol);
		 header('location: /private/public_html/board/' . $GLOBALS['url_loc'][2]);
		}
	
  // collect value of input field
		if(isset($_POST['remove'])){
		$taskId = $_POST['remove'];
		User::deleteTask($taskId);
		 header('location: /private/public_html/board/' . $GLOBALS['url_loc'][2]);	
		}

		if(isset($_POST['taskname'])){
  // collect value of input field
		$taskname = $_POST['taskname'];
		
	if($_POST['taskname'] != ""){	
User::createTask($taskname, $GLOBALS['url_loc'][2]);
  header('location: /private/public_html/board/' . $GLOBALS['url_loc'][2]);
	} else {
	echo "something went wrong!";
	}
		}
		
		
}




} else {
 die('Board does not exist');
}
	}




?>