<!doctype html>
<html>
<head></head>
<body>

<?php

include "database_conn.php";
$conn=OpenCon();
if ($conn)
  echo "db conn";

if(!empty($_POST))
{
$lat=$_POST['lat'];
$long=$_POST['long'];
$ldarea=$_POST['ldarea'];
$crop=$_POST['Crop'];
$S_type=$_POST['Stype'];
echo "post ";
}

$que = "insert into land (fid, latitude, longitude, landarea, crop, soil_type) values (1, '$lat', '$long', '$ldarea', '$crop', '$S_type')"; 

mysqli_query($conn, $que);
CloseCon($conn);
?>
</body>
</html>