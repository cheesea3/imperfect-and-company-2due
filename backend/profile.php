<?
if (User::isLoggedin()){
	header("Location: https://imperfectandcompany.com/private/public_html/home");
}

$username = "";
//checks if user is logged in
if(user::isLoggedIn()){
echo "logged in";
}
//uses get method to grab information
if (isset($_GET['username'])) {
	if(DatabaseConnector::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))){
	$username = DatabaseConnector::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
	
	//check if follow button was hit
	if(isset($_POST['follow'])) {
		
		//get the id of the user we are trying to follow
		$userid = DatabaseConnector::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username));
		
		
		//check if the user is not following that user
		if (!DatabaseConnector::query('SELECT follower_id FROM followers WHERE user_id=:userid', array(':userid' =>$userid){
			//insert query to follow the user
			DatabaseConnector::query('INSERT INTO follower (user_id, follower_id) VALUES (:userid, :followerid)', array(':userid'=>$userid,':followerid'=>$followerid));
		}
	
	echo "this yo baby <br>";	
	} else {
			die('User not found!');
	}
}	

?>