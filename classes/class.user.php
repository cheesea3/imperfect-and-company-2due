<?php

class User {
/**
 * Function to test if user is logged in or not
 * Returns a boolean value of true or false depending on if a user is logged in or not
 */
public static function isLoggedIn()
{
	//looks for cookie that is stored
	if(isset($_COOKIE['2DUEID'])) {
		//db check to see if the token is valid
		if (DatabaseConnector::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['2DUEID'])))) {
			//grab and return user id
			$userid = DatabaseConnector::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['2DUEID'])))[0]['user_id'];

			if (isset($_COOKIE['2DUEID_'])) {
			return $userid;
			} else {
				$cstrong = True;
				$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				DatabaseConnector::query('INSERT INTO login_tokens (token, user_id) VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
				DatabaseConnector::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['2DUEID'])));
				
				setcookie("2DUEID", $token, time() + 60 * 60 * 24 * 7, '/', 'imperfectandcompany.com', TRUE, TRUE);
				// create a second cookie to force the first cookie to expire without logging the user out, this way the user won't even know they've been given a new login toke
				setcookie("2DUEID_", '1', time() + 60 * 60 * 24 * 3, '/', 'imperfectandcompany.com', TRUE, TRUE);	

				return $userid;
			}

		} 
	} 
	
	return false;	
}



/**
 * Function to insert a new board
 * Creates a new board
 */
public static function createBoard($boardname) {
$userid = User::isLoggedIn();	
  DatabaseConnector::query('INSERT INTO boards (userid, name, archive, date_created) VALUES (:userid, :boardname, "0", UNIX_TIMESTAMP())',array(':userid'=>$userid, 'boardname'=>$boardname));
}


/**
 * Function to create a new task
 * Creates a new board
 */
public static function createTask($taskname, $boardid) {
  DatabaseConnector::query('INSERT INTO board_items (board_id, name, board_column) VALUES (:boardid, :name, "0")',array(':boardid'=>$boardid, ':name'=>$taskname));
}

/**
 * Function to delete a board
 * Creates a new board
 */
public static function deleteBoard($boardId) {
//delete board
  DatabaseConnector::query('DELETE FROM boards WHERE ID = :boardId',array(':boardId'=>$boardId));
  //delete board items
  DatabaseConnector::query('DELETE FROM board_items WHERE board_id=:boardId', array(':boardId'=>$boardId));
}

/**
 * Function to delete a task
 * removes selected boardid from board_items
 */
public static function deleteTask($taskId) {
  //delete board items
  DatabaseConnector::query('DELETE FROM board_items WHERE ID=:taskid', array(':taskid'=>$taskId));
}

/**
 * Function to move a task
 * updates selected task
 */
public static function moveTask($taskId, $taskCol) {
  //move board item

  DatabaseConnector::query('UPDATE board_items SET board_column=:board_column WHERE ID=:taskid', array(':taskid'=>$taskId,':board_column'=>$taskCol));

}

public static function getBoardName($boardId)
{
	//grabs the userid of the given username $id. else return false.
	if(DatabaseConnector::query('SELECT name FROM boards WHERE ID=:boardId', array(':boardId'=>$boardId))){

	return DatabaseConnector::query('SELECT name FROM boards WHERE ID=:boardId', array(':boardId'=>$boardId))[0]['name'];
	}
	else {

	return false;
	}
}

public static function getBoardUser($boardId)
{
	//grabs the userid of the given username $id. else return false.
	if(DatabaseConnector::query('SELECT userid FROM boards WHERE ID=:boardId', array(':boardId'=>$boardId))){

	$buser = DatabaseConnector::query('SELECT userid FROM boards WHERE ID=:boardId', array(':boardId'=>$boardId))[0]['userid'];
	
	return DatabaseConnector::query('SELECT email FROM users WHERE id=:buser', array(':buser'=>$buser))[0]['email'];
	}
	else {

	return false;
	}
}

public static function ifOwner($boardid)
{
	$userid = User::isLoggedIn();
	//grabs the userid of the given username $id. else return false.
	if(DatabaseConnector::query('SELECT name FROM boards WHERE ID=:boardId AND userid=:userid', array(':boardId'=>$boardid,':userid'=>$userid))){
	return true;
	}
	else {
	return false;
	}
}



}
