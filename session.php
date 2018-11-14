<?php  

session_start();

if (ISSET($_SESSION["username"])) {
	
    header("location:welcome.php");
	
}

?>