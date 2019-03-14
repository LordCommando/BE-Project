<!DOCTYPE html>
<html>
<head></head>
<body>

<?php

include "database_conn.php";
$conn=OpenCon();
if ($conn)
  echo "db conn<br>";

if(!empty($_POST))
{
  $lat=$_POST['lat'];
  $long=$_POST['long'];
  $ldarea=$_POST['ldarea'];
  $crop=$_POST['Crop'];
  $S_type=$_POST['Stype'];
  echo "post<br> ";
}

$que = "insert into land (latitude, longitude, landarea, crop, soil_type) values ('$lat', '$long', '$ldarea', '$crop', '$S_type')"; 
echo "inserted";
mysqli_query($conn,$que);
CloseCon($conn);
?>
</body>
</html>