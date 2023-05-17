<?php 
session_start();
ini_set('display_errors', 'Off');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: gold;
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
  			margin-top: 80px;
 
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
		var cpw=document.getElementById("cpw");
		var npw=document.getElementById("npw");
	    var atpos = EmailId.value.indexOf("@");
        var dotpos = EmailId.value.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid email-ID");
			EmailId.focus();
        	return false;
   		}
		if(cpw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			cpw.focus();
			return false;
		}
		if(npw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			npw.focus();
			return false;
		}
	}
	</script>
</head>
<body>
<?php
$conn = mysqli_connect("localhost","root","","railway");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
die('Could not connect: '.mysqli_connect_error());}
if (isset($_POST['submit'])){
$email=$_POST['email'];
$opw=md5($_POST['opw']);
$npw=md5($_POST['npw']);

$res = mysqli_query($conn,"SELECT * FROM passengers WHERE email='$email';");
$numrows = mysqli_num_rows($res);
if($numrows>0)
{
while($row = mysqli_fetch_assoc($res))
{
$dbemail = $row['email'];
$dbpassword = $row['password'];
}
if(($dbemail==$email)&&($opw==$dbpassword))
{
		$sql2 ="UPDATE 	passengers SET password='$npw' WHERE email='$dbemail';";
		if(mysqli_query($conn,$sql2))
		{  
			echo "<script type='text/javascript'>alert('Password changed successfully');</script>";
		}
		else
		{  
			echo "<script type='text/javascript'>alert('Error');</script>"; 
		}
}
else
echo "<script type='text/javascript'>alert('Incorrect password');</script>";
}
else
echo "<script type='text/javascript'>alert('User does not exist');</script>";
}
?>

<center>
	<div id="pnr"><b>Set New Password!</b>
	<table>
	<form method="post" name="forgotpswd" action="forgotpswd.php" onsubmit="return validate()">
	<tr><td>
	<div id="pnrtext">Email-ID:</td><td><input type="text" name="email" id="email" size="40" maxlength="30" placeholder="Enter email-id"></div></td></tr>
	<tr><td>
	<div id="pnrtext">Current password:</td><td><input type="text" name="opw" id="cpw" size="40" maxlength="10" placeholder="current password"></div></td></tr>
	<tr><td>
	<div id="pnrtext">New password:</td><td><input type="password" name="npw" id="npw" size="40" maxlength="30" placeholder="new password"></div></td></tr>
	<br><br><tr><td colspan=2></td></tr>
	<tr><td colspan=2>
	<input type="submit" name="submit" value="change password" class="button" id="submit">
	<input type="reset" name="reset" value="reset" class="button" id="submit"></td></tr>
    <br><tr><td colspan=2></td></tr>

	</form>
	</table>
	<a href="index.php" >HOME</a>
	</div>
</center>
</body>
</html>