<html>
<head><title>Registration</title>
<script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("email");
		var fname=document.getElementById("fname");
		var lname=document.getElementById("lname");
		var aged=document.getElementById("age");
		var mob=document.getElementById("mob");
		var gender=document.getElementById("gender");
		var atpos = EmailId.value.indexOf("@");
    	var dotpos = EmailId.value.lastIndexOf(".");
		var pw=document.getElementById("pw");
		var cpw=document.getElementById("cpw");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid email-ID");
			EmailId.focus();
        	return false;
   		}
   		if(pw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			pw.focus();
			return false;
		}
		if(fname.value.length< 1)
		{
			alert("first name cannot be empty");
            fname.focus();		
			return false;
		}
		if(lname.value.length< 1)
		{
			alert("last name cannot be empty");
	
			return false;
		}
		if(aged.value<=1)
		{
			alert("please select your correct age");
			return false;
		}
		if(isNaN(aged.value))
		{
			alert("please enter number as age.");
			aged.focus();
			return false;
		}
		if(mob.value.length< 10)
		{
			alert("phone number must contain 10 digits");
			return false;
		}
	
		return true;
	}
</script>
<style>
body {
	background: #f3e0e2;
	display: flex;
	background_color:yellow;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}
</style>
</head>
<body>
<div align="center">
<?php
 ini_set('display_errors', 'Off');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$server="localhost";
	$db="railway";
	$psd="";
	$usr="root";
	
	$conn=new mysqli($server,$usr,$psd,$db);
	if($conn->connect_error)
	{
		die("couldn't connect to the server".$conn->connect_error);
	}
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$age=$_POST['age'];
$mob=$_POST['mob'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$pw=md5($_POST['pw']);
$cpw=md5($_POST['cpw']);
if($gender==""){
	echo "<script type='text/javascript'>alert('Please choose Gender');</script>";
}
else{
if($pw==$cpw)
{
$sql = "INSERT INTO passengers (p_fname, p_lname, p_age, p_contact, p_gender, email, password) VALUES ('$fname', '$lname', '$age', '$mob', '$gender', '$email', '$pw');";
	if($conn->query($sql))
{
	?>
	<script type="text/javascript">
	alert("Registration successfull");
	</script>
	<?php
}
else
{
	?>
	<script type="text/javascript">
	alert("Cannot register you,please retry");
	</script>
	<?php
}
	
}
else{
	?>
	<script type="text/javascript">
	alert("Passwords doesn't match. ");
	</script>
	<?php
}
}}
?>


<FORM name="register" method="post" action="register.php" onsubmit="return validate()">
<TABLE border="3">
<CAPTION><br/><H1><b>Enter your details</b></H1></CAPTION>
<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
<TR>
<TD>First name:</TD>
<TD><INPUT name="fname" type="TEXT" placeholder="Enter your first name" size="30" maxlength="30" align="center" id="fname"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Last name:</TD>
<TD><INPUT type="TEXT" name="lname" align="center" size="30" maxlength="30" placeholder="Enter your last name" id="lname"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Age:</TD>
<TD><INPUT type="TEXT" name="age" align="center" size="30" maxlength="3" placeholder="Enter age" id="age"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Mobile Number:</TD>
<TD><INPUT type="TEXT" name="mob" size="30" maxlength="10" placeholder="Enter your mobile number" id="mob"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TR>
<TD>Gender:</TD>
<TD>&nbsp;&nbsp;
<INPUT type="radio" name="gender" value="Male" align="center" id="gender">Male
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="gender" value="Female" align="center" id="gender">Female
</TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Enter E-Mail ID:</TD>
<TD><INPUT name="email" type="TEXT" id="email" placeholder="Enter your E-Mail ID" size="30" maxlength="30"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Password:</TD>
<TD><INPUT type="PASSWORD" name="pw" size="30"  id="pw"></TD>
</TR><tr></tr><tr></tr>
<TR>
<TD>Confirm Password:</TD>
<TD><INPUT type="PASSWORD" name="cpw" size="30" id="cpw"></TD>
</TR><tr></tr><tr></tr><tr></tr><tr></tr>
<tr></tr><tr></tr><tr></tr>
</TABLE>
<P><INPUT TYPE="Submit" value="Submit" name="submit" id="submit" class="button" onclick="if(!this.form.tc.checked){alert('You must agree to the terms first.');return false}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<INPUT TYPE="Reset" value="Reset" id="reset" class="button"></P></FORM><br/>
<HR>
<FORM action="login.php">
<P>
Already have an account with us?<BR/>
<INPUT TYPE="submit" value="Login" id="login" class="button">
</P>
</FORM>
</div>
</body>
</html>



