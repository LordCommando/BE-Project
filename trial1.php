<html>
    <head>
    </head>
    <body>
    <?php

$lat=$_GET['lat'];
$long=$_GET['long'];

$command = escapeshellcmd("darksky.py $lat $long");
$output = shell_exec($command);
echo $output;


include 'database_conn.php';

$conn=OpenCon();

if($conn){

$sql = "select summary from weather";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo $row['summary'];
    }
}
}

?>

    </body>
</html>
