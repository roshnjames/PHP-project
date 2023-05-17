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
$report=$_POST["review"];
$email=$_POST["email"];
$rating=$_POST["rating"];

$sqlc="SELECT * FROM passengers WHERE email='$email';";
$res=mysqli_query($conn,$sqlc);
if($res->num_rows>0)
{
if($rating=="")
{
	echo "<script type='text/javascript'>alert('Please Rate Our Services');</script>";
}
else
{

$sql="INSERT INTO review(rvid,email,review,rating)VALUES('','$email','$report',$rating);";
if($conn->query($sql))
	echo "<script type='text/javascript'>alert(' Thank You for your feedback!');</script>";
else 
	echo "<script type='text/javascript'>alert('Failed to submit,please retry!');</script>";
}}
else
	echo "<script type='text/javascript'>alert('Please Register Yourself!');</script>";
	
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Review</title>
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
<center>

	<div id="pnr"><b>Customer Review!</b>
	<table>
	<form method="post" name="review" action="review.php" onsubmit="return validate()"><br><br>
	<tr><td><div id="pnrtext">EMAIL-ID:<br></td><td><input type="text" id="email" name="email" size="55" maxlength="30" placeholder="Enter email-id"><br></div></td></tr>
	<tr><td><div id="pnrtext">REVIEW:<br></td><td><textarea  name="review" rows="5" cols="57">
        </textarea></div></td></tr>
		<tr><td>RATING:</td><td><h4><b><font color="blue">
		<input type="radio" id="rating" name="rating" value="1">1&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" id="rating" name="rating" value="2">2&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" id="rating" name="rating" value="3">3&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" id="rating" name="rating" value="4">4&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="radio" id="rating" name="rating" value="5">5
		</h4></font></b></td></tr><tr><td rowspan=10></td></tr>
	<tr><td colspan=2><input type="submit" name="submit" value="SUBMIT" class="button" id="submit">
	<input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td colspan=2>	<a href="index.php" >HOME</a></td></tr>
	
	</form>
	</table>
	</div>
</center>
</body>
</html>