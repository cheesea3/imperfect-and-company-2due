<?php


/**
 * SELECTS all the boards pertaining to the user
 */
 
 $userid=User::isLoggedIn();
  $boards = DatabaseConnector::query('SELECT * FROM boards WHERE userid=:userid', array(':userid'=>$userid));
  

?>