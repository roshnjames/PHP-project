<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-add train</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: orange;
			width: 800px;
			height: 400px;
			margin: auto;
			border-radius: 25px;
			border: 2px solid blue; 
			margin: auto;
  			position: absolute;
  			left: 0; 
  			right: 0;
  			padding-top: 40px;
  			padding-bottom:20px;
  			margin-top: 130px;
 
		}
		html { 
		  background: url(img/bg7.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		#pnrtext	{
			padding-top: 20px;
		}
	</style>
	<script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("email");
	    var atpos = EmailId.value.indexOf("@");
        var dotpos = EmailId.value.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid EMAIL-ID");
			EmailId.focus();
        	return false;
   		}
		
	}
	</script>

</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$conn = mysqli_connect("localhost","root","","railway");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$user=$_POST["name"];
$cpw=$_POST["cpw"];
$npw=$_POST["npw"];
$cnpw=$_POST["cnpw"];
$name="jomathew@gmail.com";
$sql="SELECT * FROM passengers WHERE email='$user' AND $password='$cpw';";
if($res=$conn->query($sql)){
	if($res->num_rows>0){
		if(($user==$name)&&($cpw=="josemathew")&&($npw==$cnpw))
		{
			$sql1="UPDATE passengers SET password=$npw WHERE email='$name';";
			if($conn->query($sql1)){
			echo "<script type='text/javascript'>alert(' Train Added Successfully!');</script>";
			}else echo "<script type='text/javascript'>alert('Failed to add,please retry!');</script>";
	}else echo "<script type='text/javascript'>alert('Failed to add,please retry!');</script>";	
}
else 
	echo "<script type='text/javascript'>alert('Failed to add,please retry!');</script>";
}
}
?>
<center>

	<div id="pnr">Add Train!
	<table>
	<form method="post" name="adminpswd" action="adminpswd.php" onsubmit="return validate()"><br><br>
	<tr><td><div id="pnrtext">Email:<br></td><td><input type="text" id="email" name="name" size="40" maxlength="30"><br></div></td></tr>
	<tr><td><div id="pnrtext">Current Password:<br></td><td><input type="text"  name="cpw" size=40></div></td></tr>
		<tr><td><div id="pnrtext">New Password:<br></td><td><input type="password"  name="npw" size=40>
        </div></td></tr>
		<tr><td><div id="pnrtext">Confirm New Password:<br></td><td><input type="password"  name="cnpw" size=40>
        </div></td></tr>
	<tr><td><input type="submit" name="submit" value="UPDATE" class="button" id="submit"></td>
    <td><input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td></td><td>	<a href="admin.php" >HOME</a></td></tr>
	
	</form>
	</table>
	</div>
</center>
</body>
</html>