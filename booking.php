
<!DOCTYPE html> 
<html>
<head>
	<title>Book Here!</title>
	<LINK REL="STYLESHEET" HREF="STYLE.CSS">
	<style type="text/css">
		#pnr	{
			font-size: 20px;
			background-color:gold;
			width: 800px;
			height: 980px;
			margin: auto;
			border-radius: 25px;
			border: 2px solid blue; 
			margin: auto;
  			position: absolute;
  			left: 0; 
  			right: 0;
  			padding-top: 25px;
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
			var num=document.getElementById("nump");
	        if(num.value.length<1){
				alert("Please Enter Passengers Count!");
		        return false;
		    }
			if(isNaN(num.value)){
				alert("Characters are not allowed!");
		        return false;
		    }
			
			var jstart=document.getElementById("jstart");
			if(jstart.selectedIndex==0)
			{
				alert("Please select your departure station");
				jstart.focus();
				return false;		
			}
			var jend=document.getElementById("jend");
			if(jend.selectedIndex==0)
			{
				alert("Please select your destination station");
				jend.focus();
				return false;		
			}
			var trains=document.getElementById("trains");
			if(trains.selectedIndex==0)
			{
				alert("Please select your train");
				trains.focus();
				return false;		
			}
		    
		}
	</script>
</head>
<body>
<?php 
session_start();

ini_set('display_errors', 'Off');
if(empty($_SESSION["email"]))
{
	
	$_SESSION["flag"]=1;
    echo "<script type='text/javascript'> alert('Please Login to proceed further!');
	window.location = 'http://localhost/photoprowess/login.php';
	</script>";
}
else
{

$conn = mysqli_connect("localhost","root","","railway");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['submit']))
{
$package=$_POST['package'];
$travel=$_POST['nump'];
$tname=$_POST['trains'];




$seatnums="SELECT rseats FROM trains WHERE tno='$tname';";
$result1= mysqli_query($conn,$seatnums);
$row1= mysqli_fetch_assoc($result1);
$remaining=$row1['rseats'];
$newrseats=$remaining-$travel;
	
if($result2=$conn->query("SELECT MAX(pnrno) FROM pnr;"))
{
	
	if($row2= mysqli_fetch_array($result2)){
	$pnrno=$row2[0];
    $pnrno=$pnrno+1;
    }
$count=$travel;

}

$email=$_SESSION["email"];
if($newrseats>0)
{

$qry="SELECT pcost FROM package WHERE pid='$package';";
$costquery="SELECT JAMT FROM JOURNEY WHERE JSTART='".$_POST['jstart']."' AND JEND='".$_POST['jend']."'";

	$result = mysqli_query($conn,$qry);
	$costres = mysqli_query($conn,$costquery);
    $row = mysqli_fetch_assoc($result);
	$row2 = mysqli_fetch_array($costres);
    $cost=$row["pcost"];
    $total=$cost*$count+(intval($row2[0]));
	$train=$_POST['trains'];

$query="INSERT INTO booking(tno,email,pnrno)VALUES($train,'$email',$pnrno);";
if($conn->query($query))
{ 
   $q="INSERT INTO pnr VALUES($train,'$email',$pnrno,$count);";
   if( $conn->query($q))
	   
   { 
	   $message = "Success!    Your Ticket PNR No. :".$pnrno;
	   
	   echo "<script type='text/javascript'>
	alert('Total Amount to pay : Rs.'+$total+'/-');</script>";
   }
}

	
	$lastsql="UPDATE trains SET rseats=$newrseats WHERE tno='$tname';";
	mysqli_query($conn,$lastsql);
}
	else {
		$message=" failed";
	}
	echo "<script type='text/javascript'>alert('$message');</script>";
	echo "<script type='text/javascript'>alert('Scroll down to scan QR code!');</script>";
	
}
$sqlp="SELECT pname FROM package WHERE pid=$package;";
$resp=$conn->query($sqlp);
$rowp=mysqli_fetch_array($resp);
$_SESSION["package"]=$rowp[0];




$sqlt="SELECT tname FROM trains WHERE tno=$tname;";
$res1=$conn->query($sqlt);
$row1=mysqli_fetch_array($res1);
$_SESSION["tname"]=$row1[0];

$sql1="SELECT MAX(bid) FROM booking;";
$res=$conn->query($sql1);
$row=mysqli_fetch_array($res);

$_SESSION["bid"]=$row[0];
$_SESSION["flag"]=0;
$_SESSION["pnr"]=$pnrno;
$_SESSION["amount"]=$total;
$_SESSION["count"]=$travel;
$_SESSION["jstart"]=$_POST['jstart'];
$_SESSION["jend"]=$_POST['jend'];
}
?>
<center>
<table>
	<div id="pnr"><b>Book Your Ticket Here!</b>
	<form method="post" name="booking" action="booking.php" onsubmit="return validate()">
	<div id="pnrtext"><input type="text" id="nump" name="nump" size="40" maxlength="30" placeholder="Enter number of passengers"></div>
	<div id="pnrtext"><small>Select Class</small>
	<select name="package" id="package">
       <option value="1">AC First Class</option>
	   <option value="2">AC 2 Tier</option>
       <option value="3">AC 3 Tier</option>
       <option value="4">AC 3 Economy</option>
       <option value="5">Sleeper Class</option>
	   <option value="6">General</option>
    </select></div>
	<br><br>
	<?php
	$conn=new mysqli("localhost","root","","railway");
	  $q="SELECT DISTINCT jstart FROM journey";
	  if($res=$conn->query($q)){
		  echo "<select id='jstart' name='jstart' required>";
			echo"<option selected disabled>---Select Start Point---</option>";
		  while($row=$res->fetch_assoc()){
		
			echo"<option value='".$row['jstart']."' >".$row['jstart']."</option>";
			
		
		  }
		  echo"</select>";
	  }
		?><br><br>
		<?php
	  $q="SELECT DISTINCT jend FROM journey";
	  if($res=$conn->query($q)){
		  echo "<select id='jend' name='jend' required>";
			echo"<option selected disabled>---Select Destination---</option>";
		  while($row=$res->fetch_assoc()){
		
			echo"<option value='".$row['jend']."' >".$row['jend']."</option>";
			
		
		  }
		  echo"</select>";
	  }?>
	  <br><br>
	  <?php
	  $q="SELECT * FROM TRAINS";
	  if($res=$conn->query($q)){
		  echo "<select id='trains' name='trains' required>";
			echo"<option selected disabled>---------Trains Available-----------</option>";
		  while($row=$res->fetch_assoc()){
		
			echo"<option value='".$row['tno']."' >".$row['tname']."</option>";
			
		
		  }
		  echo"</select>";
	  }
		?><br><br>
	<input type="submit" name="submit" value="SUBMIT" class="button" id="submit">
    <input type="reset" name="reset" value="RESET" class="button" id="reset"><br/>
    <br>	<a href="index.php">HOME</a><br><br>
	<a href="login.php">Login</a>
	<br>
	</form><br><br><br><br><br><br>
	<img src="qrcode.png" height="300" width="300" alt="Failed to load QR code"></img>
	<br><b>Scan this QR code for transaction.</b><br><br>
	<a href="ticket.php"><b>Download Ticket PDF</b></a>
	</div>
</center>
</body>
</html>

