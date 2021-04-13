<?php

if (User::isLoggedin()){
	header("Location: https://imperfectandcompany.com/private/public_html/home");
}

//check if user hit the reset button
if(isset($_POST['resetpassword'])){
	
if(isset($_POST['g-recaptcha-response'])) {
	
   // RECAPTCHA SETTINGS
   $captcha = $_POST['g-recaptcha-response'];
   $ip = $_SERVER['REMOTE_ADDR'];
   $key = $GLOBALS['captchakey'];
   $url = 'https://www.google.com/recaptcha/api/siteverify';

   // RECAPTCH RESPONSE
   $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
   $data = json_decode($recaptcha_response);	
	
		
try{ 
	///checks to see if captcha came thru
	if(isset($data->success) &&  $data->success === true) { 
	if(!isset($_POST['email']) || !$_POST['email']){ throw new Exception('Error: You did not provide an email!'); }	
	//set variables
	$email = $_POST['email'];
	
	//php built in validator for email, if valid then insert
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	//Before we continue, does this email exist?
	if (DatabaseConnector::query('SELECT email from users where email=:email', array(':email'=>$email))) { 
	//generate a random token
		$cstrong = True;
		$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
		$email = $_POST['email'];
		//set value to user_id
		$user_id = DatabaseConnector::query('SELECT id FROM users where email=:email', array(':email'=>$email))[0]['id'];
		//query the database and insert into the tokens table
		DatabaseConnector::query('INSERT INTO password_tokens (token, user_id) VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
		echo $user_id;
		echo 'email sent <br>';
	    $success = 1;		
		echo $token; 
	} else {
		throw new Exception('Error: Email does not exist!');		
	}	
	} else {
		throw new Exception('Error: Email is invalid!'); 	
	}
	} else {
		throw new Exception('Error: Please try submitting the captcha again!');		
	}	
	}	catch (Exception $e) {
                $GLOBALS['errors'][] = $e->getMessage();
            }	
	
	



}
}
?>