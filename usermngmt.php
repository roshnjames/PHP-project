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
$pid=$_POST["pid"];
$sql="SELECT * FROM passengers WHERE pid=$pid;";
if($res=$conn->query($sql)){
	if($res->num_rows>0){
		$sql1="DELETE FROM passengers WHERE pid=$pid;";
		if($conn->query($sql1)){
			echo "<script type='text/javascript'>alert(' User Account Deleted Successfully!');</script>";
		}
    }
else 
	echo "<script type='text/javascript'>alert('Failed to Delete,please retry!');</script>";
}
}}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-manage user</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: SpringGreen;
			width: 1200px;
			height: 1300px;
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
		var pid=document.getElementById("pid");
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

	<div id="pnr"><b>Manage Users!</b><br><br>
	<table>
	<form method="post" name="usermngmt" action="usermngmt.php" onsubmit="return validate()">
	<tr><td><div id="pnrtext">Enter user Id to delete:</td><td><input type="text" id="pid" name="pid" size="40" maxlength="30"></div></td></tr>
	<tr><td><input type="submit" name="submit" value="DELETE" class="button" id="submit"></td>
    <td><input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td colspan=2>	<a href="admin.php" >HOME</a></td></tr>
	<?php
	$conn=new mysqli("localhost","root","","railway");
	  $q="SELECT * FROM passengers";
	  echo "<table border=1>";
	  echo "<tr><th>p_id</th><th>First name</th><th>Last name</th><th>Age</th><th>Contact</th><th>Gender</th><th>Email ID</th><th>Password</th></tr>";
	  if($res=$conn->query($q)){
		  while($row=$res->fetch_assoc()){
			 echo "<tr>";
		
			echo "<td>".$row['pid']."</td>";
			echo "<td>".$row['p_fname']."</td>";
			echo "<td>". $row['p_lname']."</td>";
			echo "<td>". $row['p_age']."</td>";
			echo "<td>".$row['p_contact']."</td>";
			echo "<td>".$row['p_gender']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "</tr>";
			
		
		  }
		echo "</table>";
	  }?>
	</form>
	</table>
	</div>
</center>
</body>
</html>