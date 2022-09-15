<?php 
session_start();

// deletion of all session variables
$_SESSION = array();
session_destroy();
	
// redirect the user back to the login page
header("Location: login.php");
exit();

?>