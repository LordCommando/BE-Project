<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>

    <?php
		session_start();
		
		if(isset($_SESSION['fid']))
		{
		?>
		<a href="logout.php" style="float:right">Logout</a>		
		<?php		
			echo "<br><br>";
			die ("Already Logged In");
		}
	?>
    <a href="signup.php" style="float:right">Sign Up</a>
    <form action="logincheck.php" method="post">
        Email: <input type="text" id="email" name="email"><br><br>
        Password: <input type="password" id="pwd" name="pwd"><br><br>
        <input type="submit">
	</form>
    <?php
		if(isset($_GET['status']))
		{
			echo $_GET['status'];
		}
    ?>
</body>
</html>