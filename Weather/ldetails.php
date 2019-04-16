<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script> -->
    <script>
    function getLocation() 
    {
        navigator.geolocation.getCurrentPosition(showPos);
    }

    function showPos(position)
    {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        document.getElementById("lati").value=lat;
        document.getElementById("longi").value=long;
    }
</script>
</head>
<body onload="getLocation()">
    <table>

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

            // $result= Mysqli_Query($conn, "Select (max(fid)+1 ) from farmer");
            // $row= mysqli_fetch_row($result);
            // if($row[0] !=NULL) {
            //     $no = $row[0];
            // } else {
            //     $no = 1;
            // }
            $no = $_SESSION['fid'];
            $que = "insert into farmer values ($no, '$fname', '$lname', '$city', '$taluka', '$district', '$state', '$pincode', '$mobile', '$landline', '$email', '$photo')"; 
            mysqli_query($conn,$que);
        }
    ?>
    <form method="post" action="weathershow.php">
    <tr> <input id="lati" type="text" name="lat" readonly="readonly" required><br><br></tr>
    <input id="longi" type="text" name="long" readonly="readonly" required><br><br>
    <input type="text" name="ldarea" placeholder="Land Area" required><br><br>
    <input type="text" name="Crop" placeholder="Crop" required><br><br>
    <input type="text" name="Stype" placeholder="Soil Type" required><br><br>
    <input type="submit" value="Submit">
    </form> 
    </table>
</body>
</html>