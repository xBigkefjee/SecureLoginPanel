<?php
// clean headers
ob_start();
// do not show errors
error_reporting(0);
// get variables send by ajax from login page
$requested_username = $_REQUEST['a'];
$requested_password = $_REQUEST['b'];
// extra validation if there is something send or not
if(!$requested_username) die('Error'); 
// connect to database : ip, user, password, database name
$connectioninfo = mysqli_connect('localhost', 'db_username', 'db_password', 'db_name') or die('Error connecting to database' );
// query the database and retrieve data
$result = mysqli_query($connectioninfo, 'SELECT * FROM `users`');
// for each returned row from the result
foreach($result as $row){
        // get variables out of result
        $user = $row[username];
        $pass = $row[password];
	// check if username is present in database
	if($requested_username == $user){
	  // hashing the user entered password
		$hash = hash('sha512', $requested_password);
		// check if the password filled in and hashed is equal to the hashed password in database from that user
		if($hash == $pass){
		  // start php session
			session_start();
			// log that user has logged in
			loglogin('Login success');
			// set the session variable to the useragent
			$_SESSION['useragent'] = hash('sha512',$_SERVER['HTTP_USER_AGENT']);
			// close php script and redirect user
			die('Logged in user: '.$user.', welcome '.$name.'.|index.php');
		}else{
			// log that user got denied at password
			loglogin('Denied at password');
		  // stop script
			denied();	
		}
	}else{
		// log that user got denied at username
		loglogin('Denied at username');
		// stop script
		denied();
	}
}
function loglogin($errormsg){
  // get variables of user
	$current_useragent = $_SERVER['HTTP_USER_AGENT'];
	$current_ip = $_SERVER['REMOTE_ADDR'];
	$current_proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$current_date = date('d').'-'.date('n').'-'.date('Y');
	// the +2 can diffirenciate on ur timezone.
	$current_time = (date('H')+2).':'.date('i').':'.date('s');
	global $requested_password;
	global $requested_username;
	if($errormsg == 'Login success') $requested_password = hash('sha512',$requested_password);
	$entered_username = stripslashes($requested_username);
	$entered_password = stripslashes($requested_password);
	// connect to database : ip, user, password, database name
$connectioninfo = mysqli_connect('localhost', 'db_username', 'db_password', 'db_name');
	mysqli_query($connectioninfo, "INSERT INTO loginlogs (`id`, `username`, `password`, `time`, `date`, `useragent`, `ip`, `proxy`, `errormsg`) VALUES (NULL, '".$entered_username."', '".$entered_password."', '".$current_time."', '".$current_date."', '".$current_useragent."', '".$current_ip."', '".$current_proxy."', '".$errormsg."');");
}
function denied(){
	die('Username is unknown or the password is incorrect.|loginform.php');
}
?>
