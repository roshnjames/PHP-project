<?php 
session_start();
ini_set('display_errors', 'Off');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$conn = mysqli_connect("localhost","root","","railway");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$report=$_POST['report'];
$email=$_POST["email"];
$sqlc="SELECT * FROM passengers WHERE email='$email';";
$res=mysqli_query($conn,$sqlc);
if($res->num_rows>0)
{
	if($report=="")
	{
		"<script type='text/javascript'>alert('Describe your Problem.');</script>";
	}
	else
	{
$sql="INSERT INTO report(rpid,email,reports)VALUES('','$email','$report');";
if($conn->query($sql))
	echo "<script type='text/javascript'>alert('Reporting Successfull!');</script>";
else 
	echo "<script type='text/javascript'>alert('Reporting Failed');</script>";
}}
else
	echo "<script type='text/javascript'>alert('Please Register Yourself!');</script>";
}}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reporting</title>
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
	
</head>
<body>
<script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("email");
	    var atpos = EmailId.value.indexOf("@");
        var dotpos = EmailId.value.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid Email-ID");
			EmailId.focus();
        	return false;
   		}
		var report=document.getElementById("report");
		if (report.value.length<2)
        {
            alert('Empty !!');
			report.focus();
			return false;
        }
		
	}
	</script>
<center>
	<div id="pnr"><b>Report your problem here!</b>
	<table><form method="post" name="report" action="report.php" onsubmit="return validate()">
	<tr><td><div id="pnrtext">EMAIL-ID:</td><td><input type="text" id="email" name="email" size="48" maxlength="30" placeholder="Enter email-id"></div></td></tr>
	<tr><td><div id="pnrtext">PROBLEM DESCRIPTION:</td><td><textarea  name="report" id="report" rows="6" cols="50" class="input" WRAP>
        </textarea></div></td></tr>
	<br>
	<tr><td><input type="submit" name="submit" value="REPORT" class="button" id="submit"></td><br>
   <td> <input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr><br/><tr></tr>
   <tr><td> </td><br><td>	</td></tr><tr></tr>
   <tr><td colspan=2></td></tr>
	
	</table>
	</form>
	<a href="index.php" ><b>HOME</b></a>
	<br><br>
	Let us Contact You!
	</div>
</center>
</body>
</html>