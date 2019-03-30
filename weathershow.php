<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Show Weather</title>
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
		}
        include "database_conn.php";
        $conn=OpenCon();
        if ($conn)
        // echo "db conn<br>";

        if(!empty($_POST))
        {
        $lat=$_POST['lat'];
        $long=$_POST['long'];
        $ldarea=$_POST['ldarea'];
        $crop=$_POST['Crop'];
        $S_type=$_POST['Stype'];
        // echo "post<br> ";
        }

        // $result= Mysqli_Query($conn, "Select (max(fid) ) from farmer");
        // $row= mysqli_fetch_row($result);
        //     if($row[0] !=NULL) {
        //     $no = $row[0];
        //     } else {
        //     $no = 1;
        //     }
        $no = $_SESSION['fid'];
        $que = "insert into land values ($no, '$lat', '$long', '$ldarea', '$crop', '$S_type')"; 
        // echo "inserted";
        mysqli_query($conn,$que);

        $command = escapeshellcmd("darksky.py $lat $long");
        $output = shell_exec($command);
        
        $sql = "select summary from weather";
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['summary'];
            }
        }
        CloseCon($conn);
        // die(header("Location:trial1.php?lat=$lat&long=$long"));
    ?>

    <form action='stage.php' method='post'>
        Please Select the stage you are in:<br><br>
    <input type='submit' value='0' name='state'><br><br>
    <input type='submit' value='1' name='state'><br><br>
    <input type='submit' value='2' name='state'><br><br>
    <input type='submit' value='3' name='state'><br><br>
    <input type='submit' value='4' name='state'><br><br>
    <input type='submit' value='5' name='state'><br><br>
    <input type='submit' value='6' name='state'><br><br>
    <input type='submit' value='7' name='state'><br><br>
    </form>

</body>
</html>