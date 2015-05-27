<?php
// clean headers
ob_start();
// do not show errors
error_reporting(0);
// get variables send by ajax from login page
$requested_username = $_REQUEST['a'];
$requested_password = $_REQUEST['b'];
$requested_name = $_REQUEST['c'];
// extra validation if there is something send or not
if(!$requested_username) die('Error');
// connect to database : ip, user, password, database name
$connectioninfo = mysqli_connect('localhost', 'db_username', 'db_password', 'db_name') or die('Error connecting to database' );
// query the database and retrieve data
try{ 
    $requested_username = stripslashes($requested_username);
    $result = mysqli_query($connectioninfo, 'SELECT * FROM `users`');
    // for each returned row from the result
    foreach($result as $row){
        if($row[username] == $requested_username) die('Username already exists.|');
    }
    $requested_name = stripslashes($requested_name);
    $requested_password = stripslashes($requested_password);
    $requested_password = hash('sha512',$requestedpassword);
    mysqli_query($connectioninfo, "INSERT INTO users (`id`, `username`, `password`, `name`) VALUES (NULL, '".$requested_username."', '".$requested_password."', '".$requested_username."')");
    die('Registered user: '.$requested_name.'.|index.php');
}
catch(mysqli_sql_exception $e){
    die('Something went wrong with the database, contact ur system administrator.|');   
}
?>
