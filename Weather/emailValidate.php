<?php

$var=$_GET['email'];

$conn=mysqli_connect('localhost','root');
mysqli_select_db($conn,'darktest');

$sql="SELECT email FROM flogin";

$res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$rowcount = mysqli_num_rows($res);

$there=false;

if(mysqli_num_rows($res) > 0)
{
	while($rowcount > 0)
	{
		$row = mysqli_fetch_array($res);
		$name = $row['email'];
		
		if($name === $var)
		{
			$there = true;
			break;
		}
		$rowcount--;
	}
}

if($there)
{
	echo "Email exists. Please select new email";
}
else
{
	echo "Email accepted";
}

mysqli_close($conn);
?>