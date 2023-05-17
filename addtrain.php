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
$tno=$_POST["no"];
$tname=$_POST["name"];
$tseats=$_POST["tseats"];
$rseats=$_POST["tseats"];
$sql="INSERT INTO trains VALUES($tno,'$tname',$tseats,$rseats);";
if($conn->query($sql))
	echo "<script type='text/javascript'>alert(' Train Added Successfully!');</script>";
else 
	echo "<script type='text/javascript'>alert('Failed to add,please retry!');</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-add train</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: SpringGreen;
			width: 800px;
			height: 900px;
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

</head>
<body>
<center>

	<div id="pnr"><b>Add Train+</b>
	<table>
	<form method="post" name="addtrain" action="addtrain.php" onsubmit="return validate()"><br><br>
	<tr><td><div id="pnrtext">Train no.:<br></td><td><input type="text" id="email" name="no" size="40" maxlength="30"placeholder="should be unique"><br></div></td></tr>
	<tr><td><div id="pnrtext">Train Name:</td><td><input type="text"  name="name" size=40></div></td></tr>
		<tr><td><div id="pnrtext">Total seats:</td><td><input type="text"  name="tseats" size=40>
        </div></td></tr>
	<tr><td><input type="submit" name="submit" value="ADD" class="button" id="submit"></td>
    <td><input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td colspan=2>	<a href="admin.php" >HOME</a></td></tr>
	
	</form>
	<?php
	$conn=new mysqli("localhost","root","","railway");
	  $q="SELECT * FROM trains";
	  echo "<table border=1>";
	  echo "<tr><th>Train no.</th><th>Train name</th><th>Total seats</th><th>Remaining seats</th></tr>";
	  if($res=$conn->query($q)){
		  while($row=$res->fetch_assoc()){
			 echo "<tr>";
		
			echo "<td>".$row['tno']."</td>";
			echo "<td>". $row['tname']."</td>";
			echo "<td>". $row['tseats']."</td>";
			echo "<td>".$row['rseats']."</td>";
			echo "</tr>";
			
		
		  }
		echo "</table>";
	  }?>
	</table>
	</div>
</center>
</body>
</html>