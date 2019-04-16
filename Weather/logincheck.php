<?php
    include "database_conn.php";
    $conn=OpenCon();
    $em=$_POST['email'];
	$pwd=$_POST['pwd'];
	
		$s = "Select * from flogin Where email='$em' And pwd='$pwd'";
	
	$result = MySqli_Query( $conn,$s);
		$row = MySqli_Fetch_Assoc( $result );
		if( $row== true )
		{
			Session_Start();
			$_SESSION['fid']=$row['fid'];
			CloseCon($conn);
			die(header("Location:trial.php"));
		}
		else
		{
            CloseCon($conn);
			die(header("Location: login.php?status=Login Failed. Sign in with the correct credentials"));
			
		}
?>