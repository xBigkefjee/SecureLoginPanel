<?php 
// filename of the loginform
$loginform = 'loginform.php';
// clean headers
ob_start();
// do not show errors
error_reporting(0);
// start php session
session_start();
// check if there is an existing php session variable 'useragent', if not present it probarely means user never logged in or the session has expired. Redirect user to the loginform.
$useragent = $_SESSION['useragent'] or die(header('Location: '.$loginform));
// check if the current hashed user agent is equal to the useragent hashed in the session variable, if not, redirect to the loginform
if(hash('sha512',$_SERVER['HTTP_USER_AGENT']) != $useragent){
	die(header('Location: '.$loginform));
}
?>
