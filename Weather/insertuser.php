<?php
	$conn = mysqli_connect( "localhost", "root","","darktest" );
	if(!$conn)
	{
		die("error:".mysqli_error());
	}
	
	$email=$_POST['email'];
	$pwd=$_POST['pwd'];
	
	$result=MySqli_Query($conn, "Select  (Max(fid)+1 )   from flogin");
	$row = MySqli_Fetch_Row( $result );
			if( $row[0] != NULL )
				$no = $row[ 0 ];
			else
				$no = 1;
	
	$sql="INSERT INTO flogin VALUES ($no,'$email','$pwd')";
	if(mysqli_query($conn,$sql))
	{
		session_start();
		
		$_SESSION['fid']=$no;
		header('Location: fdetails.php');
		
	}
?>