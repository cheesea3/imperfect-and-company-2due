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


} else {
 die('Board does not exist');
}
	}




?>