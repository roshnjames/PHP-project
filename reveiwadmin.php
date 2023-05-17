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
$rvid=$_POST["rvid"];
$sql="SELECT * FROM review WHERE rvid=$rvid;";
if($res=$conn->query($sql)){
	if($res->num_rows>0){
		$sql1="DELETE FROM review WHERE rvid=$rvid;";
		if($conn->query($sql1)){
			echo "<script type='text/javascript'>alert('Review '+$rvid+' Deleted Successfully!');</script>";
		}
    }
else 
	echo "<script type='text/javascript'>alert('Invalid Entry,Please Retry!');</script>";
}
}}
?><html>
<head>
	<title>Admin-manage reviews</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: SpringGreen;
			width: 2000px;
			height: 1100px;
			margin: auto;
			border-radius: 25px;
			border: 2px solid blue; 
			margin: auto;
  			position: absolute;
  			left: 0; 
  			right: 0;
  			padding-top: 40px;
  			padding-bottom:20px;
  			margin-top: 20px;
 
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
		var pid=document.getElementById("rvid");
		if(pid.value==""){
			alert("Please fill ID field!");
			pid.focus();
	        return false;
		} 
		if(isNaN(pid.value)){
			alert("Characters are not allowed in ID field!");
			pid.focus();
	        return false;
		} 
	}
	</script>
	</head>
<body>
<center>

	<div id="pnr"><b>Customer Reveiws</b><br><br><br>
	<table>
	<form method="post" name="reveiwadmin" action="reveiwadmin.php" onsubmit="return validate()">
	<tr><td><div id="pnrtext">Review ID:</td><td><input type="text" id="rvid" name="rvid" size="40" maxlength="30" placeholder="Enter review Id to delete"></div></td></tr>
	<tr><td colspan=2><input type="submit" name="submit" value="DELETE" class="button" id="submit">
    <input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td colspan=2>	<a href="admin.php" ><b>HOME</b></a></td></tr></table><br>
	<?php
	$conn=new mysqli("localhost","root","","railway");
	  
	  $sqlt="SELECT AVG(rating) FROM review;";
      $res1=$conn->query($sqlt);
      $row1=mysqli_fetch_array($res1);
      $ratingavg=$row1[0];
       echo "<h4 align='center'><b><font color='blue'>AVERAGE RATING UPTO NOW :</font></h4><font color='red'><h2> ".intval($ratingavg)."</font></b></h2>"; 	  
	 
	  
	  
	  
	  $q="SELECT * FROM review";
	  echo "<table border=1>";
	  echo "<tr><th>Review Id</th><th>Email ID</th><th>Reviews</th><th>Rating</th></tr>";
	  if($res=$conn->query($q)){
		  while($row=$res->fetch_assoc()){
			 echo "<tr>";
		
			echo "<td>".$row['rvid']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['review']."</td>";
			echo "<td>".$row['rating']."</td>";
			echo "</tr>";
			
		
		  }
		echo "</table>";
	  }?>
	</form>
	</div>
</center>
</body>
</html>