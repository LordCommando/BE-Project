<!DOCTYPE html>
<html>
<head>
  <script>
var x = document.getElementById("demo");
if(confirm("We need ur location"))
{
function getLocation() {
  if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
  } else {
  x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude; 
}
}
</script>
</head>
<body>
<table>

	<?php

	 include "database_conn.php";
   $conn=OpenCon();
   if ($conn)
  
   if(!empty($_POST))
   {
   $fname=$_POST['firstname'];
   $lname=$_POST['lastname'];
   $city=$_POST['city'];
   $taluka=$_POST['taluka'];
   $district=$_POST['district'];
   $state=$_POST['state'];
   $pincode=$_POST['pincode'];
   $mobile=$_POST['mobile'];
   $landline=$_POST['landline'];
   $email=$_POST['email'];
   $photo=$_POST['photo'];
  
   $que = "insert into farmer (fname, lname, city, taluka, district, state, pincode, mobile, landline, email, photo) values ('$fname', '$lname', '$city', '$taluka', '$district', '$state', '$pincode', '$mobile', '$landline', '$email', '$photo')"; 

   mysqli_query($conn,$que);
  }
   
  ?>
	<form method="post" action="home.php">
  
 <tr> <input type="number" name="lat" placeholder="Latitude" required><br><br></tr>
 
  <input type="number" name="long" placeholder="Longitude" required><br><br>
 
  <input type="text" name="ldarea" placeholder="Land Area" required><br><br>
  
  <input type="text" name="Crop" placeholder="Crop" required><br><br>
 
  <input type="text" name="Stype" placeholder="Soil Type" required><br><br>

  <input type="submit" value="Submit">
  
</form> 
</table>
</body>
</html>
