<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Farmer Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script> -->
</head>
<body>
<?php
session_start();
if(isset($_SESSION['fid']))
        {
            ?>
            <a href="logout.php" style="float:right">Logout</a>		
            <?php		
        }?>
	<form method="post" action="ldetails.php">
    <input type="text" name="firstname" placeholder="First Name" required><br><br>
    <input type="text" name="lastname" placeholder="Last Name" required><br><br>
    <input type="text" name="city" placeholder="City" required><br><br>
    <input type="text" name="taluka" placeholder="Taluka" required><br><br>
    <input type="text" name="district" placeholder="District" required><br><br>
    <input type="text" name="state" placeholder="State" required><br><br>
    <input type="number" min="400000" max="499999"name="pincode" placeholder="Pincode" required><br><br>
    <input type="number" min="7000000000" max="9999999999"name="mobile" placeholder="Mobile" required><br><br>
    <input type="number" min="20000000" max="29999999"name="landline" placeholder="Landline"><br><br>
    <input type="email" name="email" placeholder="E-mail"><br><br>
    Photo:<br>
    <input type="file" name="photo" placeholder="Photo"><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>