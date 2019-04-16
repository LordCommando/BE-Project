<?php
	session_start();
	
	unset($_SESSION['fid']);
	session_destroy();
	
	die(header("Location:trial.php?status=Logout"));
?>