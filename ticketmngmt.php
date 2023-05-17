<!DOCTYPE html>
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
	$pnr=$_POST["pnrno"];
	$sql1="SELECT * FROM booking WHERE pnrno=$pnr;";
	$res1=mysqli_query($conn,$sql1);
    $row1=mysqli_fetch_assoc($res1);
    $email=$row1['email'];
	$tno=$row1['tno'];
	
	$sql2="SELECT * FROM pnr WHERE tno=$tno AND email='$email';";
	$res2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($res2);
    $seats=$row2['count'];
	$seats=$seats+1;
	
	$sql3="UPDATE trains SET rseats=rseats+$seats WHERE tno=$tno;";
	if($conn->query($sql3))
	{
		$sql4="DELETE FROM pnr WHERE pnrno=$pnr;";
		if($conn->query($sql4))
		{
			$sql5="DELETE FROM booking WHERE pnrno=$pnr AND email='$email';";
			if($conn->query($sql5))
			{
				echo "<script type='text/javascript'>alert('Ticket Successfully Deleted.');</script>";
			}
		}else echo "<script type='text/javascript'>alert('failed.');</script>";
	}else echo "<script type='text/javascript'>alert('failed');</script>";
}else echo "<script type='text/javascript'>alert('Failure');</script>";
}	
?>	
<html>
<head>
	<title>Admin-manage tickets</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color: SpringGreen;
			width: 1000px;
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
		var pid=document.getElementById("pnrno");
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

	<div id="pnr"><b>Manage Tickets!</b><br><br>
	<table>
	<form method="post" name="ticketmngmt" action="ticketmngmt.php" onsubmit="return validate()">
	<tr><td><div id="pnrtext">Enter PNR no. to delete:</td><td><input type="text" id="pnrno" name="pnrno" size="40" maxlength="30"></div></td></tr>
	<tr><td><input type="submit" name="submit" value="DELETE" class="button" id="submit"></td>
    <td><input type="reset" name="reset" value="RESET" class="button" id="reset"></td></tr>
    <tr><td colspan=2>	<a href="admin.php" >HOME</a></td></tr>
	<?php
	$conn=new mysqli("localhost","root","","railway");
	  $q="SELECT * FROM booking";
	  echo "<table border=1>";
	  echo "<tr><th>b_Id</th><th>Train Number</th><th>Email ID</th><th>PNR number</th></tr>";
	  if($res=$conn->query($q)){
		  while($row=$res->fetch_assoc()){
			 echo "<tr>";
		
		    echo "<td>".$row['bid']."</td>";
			echo "<td>".$row['tno']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>". $row['pnrno']."</td>";
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