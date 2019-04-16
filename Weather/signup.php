<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form action="insertuser.php" method="post" id="sform" name="sform" onsubmit="return validate();">
			Email ID: <input type="text" id="email" name="email" onkeyup="return validateEmail()">&nbsp;&nbsp;<span id="valEmail"></span><br><br>
			Password: <input type="password" id="pwd" name="pwd"><br><br>
			<input type="submit">
		</form>
		<script>
		function validate()
		{	
			var x=document.forms["sform"]["email"].value;
			var dot=x.lastIndexOf(".");
			var at=x.indexOf("@");
			if(x.length >= 50)
			{
				alert("Please enter valid email id");
				return false;
			}
			if(at < 1 || dot <= at + 2 || dot + 2 >= x.length)
			{
				alert("Please enter valid email id");
				return false;
			}
			
			var x=document.forms["sform"]["pwd"].value;
			if(x.length < 5)
			{
				alert ("Password must contain more than 5 characters");
				return false;
			}
			if(document.getElementById("valEmail").innerHTML == "Email exists. Please select new email")
				return false;
		}
		
		function validateEmail()
		{
			var x=document.forms["sform"]["email"].value;
	
			var http=new XMLHttpRequest();
			http.abort();

			http.open("GET","emailValidate.php?email=" + x, true);
			http.send();
			
			http.onreadystatechange=function()
			{
				if(http.readyState == 4)
				{
					if(http.responseText === "Email exists. Please select new email")
					{
						document.getElementById("valEmail").style.color="red";
						document.getElementById("valEmail").innerHTML=http.responseText;
					}
				}
				else
				{
					document.getElementById("valEmail").innerHTML="";
				}
			}
		}
		</script>
</body>
</html>