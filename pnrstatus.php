<?php 
session_start();
ini_set('display_errors', 'Off');
$conn = mysqli_connect("localhost","root","","railway");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$pnr=$_POST['pnr'];
$sql = "SELECT email,tno FROM pnr WHERE pnrno= '$pnr'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

	if($row==NULL)
		echo "<script type='text/javascript'>alert('Invalid PNR');</script>";
	else 
		echo "<script type='text/javascript'>alert('PNR '+$pnr+' is BOOKED by ' +'$row[email]'+' in train no. '+$row[tno]);</script>";	

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PNR Status</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: gold;
			width: 700px;
			height: 500px;
			margin: auto;
			border-radius: 25px;
			border: 2px solid blue; 
			margin: auto;
  			position: absolute;
  			left: 0; 
  			right: 0;
  			padding-top: 40px;
  			padding-bottom:20px;
  			margin-top: 50px;
 
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
		var pnrno=document.getElementById("pnrno");
		if(pnrno.value=="")){
			alert("Please enter PNR number!");
			pnrno.focus();
	        return false;
		} 
		if(isNaN(pnrno.value)){
			alert("Characters are not allowed in PNR field!");
			pnrno.focus();
	        return false;
		}
	}
	</script>
</head>
<body>
<center>
	<div id="pnr"><b>Check your PNR status</b><br/><br/>
	<form method="post" name="pnrstatus" action="pnrstatus.php" onsubmit="return validate()">
	<div id="pnrtext"><input type="text" name="pnr" id="pnrno" size="30" maxlength="10" placeholder="Enter PNR here"></div>
	<br/><br/>
	<input type="submit" name="submit" value="Check here!" class="button" id="submit"><br/><br/>
	
			<br><br><a href="index.php" >HOME</a><br><br>
			<a href="login.php">Login</a>
	</form>
	</div>
</center>
</body>
</html>