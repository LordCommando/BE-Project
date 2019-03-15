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

$result= Mysqli_Query($conn, "Select (max(fid) ) from farmer");
$row= mysqli_fetch_row($result);
    if($row[0] !=NULL) {
      $no = $row[0];
    } else {
      $no = 1;
    }
$que = "insert into land values ($no, '$lat', '$long', '$ldarea', '$crop', '$S_type')"; 
echo "inserted";
mysqli_query($conn,$que);
CloseCon($conn);
?>
</body>
</html>