
<!DOCTYPE html>
<html>
<head>
	<title>Ticket Cancellation</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: gold;
			width: 700px;
			height: 350px;
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
		var EmailId=document.getElementById("email");
	    var atpos = EmailId.value.indexOf("@");
        var dotpos = EmailId.value.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid Email-ID");
			EmailId.focus(); 
        	return false;
   		}
		if(pnrno.value==""){
			alert("Please enter PNR number");
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
$pnr=$_POST["pnr"];
$email=$_POST["email"];
$pswd=md5($_POST["pswd"]);
$ssql="SELECT * FROM passengers WHERE email='$email' AND password='$pswd';";
if($resp=mysqli_query($conn,$ssql)){
$row = mysqli_fetch_assoc($resp);
$pss=$row['password'];
$sql1="SELECT * FROM booking WHERE pnrno=$pnr AND email='$email';";
$result=$conn->query($sql1);
if(($result->num_rows>0)&&($pss==$pswd))
{
	$row= mysqli_fetch_assoc($result);
	$tno=$row['tno'];
	echo "<script type='text/javascript'>alert('Ticket Cancellation Successfull!  Your money will be refunded within 3 days');</script>";
	$sql3="SELECT count FROM pnr WHERE pnrno=$pnr;";
	$res=mysqli_query($conn,$sql3);
	if($row=mysqli_fetch_array($res)){
	$seats=$row[0];
	}
	
	$sql = "DELETE FROM booking WHERE pnrno=$pnr AND email='$email';";
	mysqli_query($conn,$sql);
	$sql2="UPDATE trains SET rseats=rseats+$seats WHERE tno=$tno;";

    if(mysqli_query($conn,$sql2))
	{
		mysqli_query($conn,"DELETE FROM pnr WHERE pnrno=$pnr;");
	}
	

else 
	echo "<script type='text/javascript'>alert('Cancellation failed, please retry!');</script>";
}	
else 
echo "<script type='text/javascript'>alert('Invalid Entry');</script>";}}}
?>
<center>
	<div id="pnr"><b>Cancel your TICKET here!</b><br/><br/>
	<form method="post" name="cancellation" action="cancellation.php" onsubmit="return validate()">
	<div id="pnrtext">PNR NUM:<input type="text" name="pnr" id="pnrno" size="40" maxlength="10" placeholder="Enter PNR here"></div>
	<div id="pnrtext">EMAIL-ID:<input type="text" name="email" id="email" size="40" maxlength="30" placeholder="Enter email-id"></div>
	<div id="pnrtext">Password:<input type="password" name="pswd" id="pswd" size="40" maxlength="30" placeholder="Enter password"></div>
	<br><br>
	<input type="submit" name="submit" value="CANCEL TICKET" class="button" id="submit">
	<input type="reset" name="reset" value="RESET" class="button" id="submit"><br/><br/>
    <br><br>	<a href="index.php" >HOME</a>
	</form>
	</div>
</center>
</body>
</html>