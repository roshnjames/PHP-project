
<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
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
	<?php
session_start();
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

	$email=$_POST["email"];
	$pw=md5($_POST["pw"]);
	$_SESSION["pw"]=$pw;
	$_SESSION["email"]=$email;
	$f=$_SESSION["flag"];
	if(($email=="miniproject@gmail.com")&&($pw=="af08ba700b38a338306fc8d4869d7b62"))
	{
		$_SESSION['admin_mode']=1;
		header("Location:admin.php");
	}
	else{
	$qry="SELECT * FROM passengers WHERE email = '$email' AND password = '$pw';";
	$result=$conn->query($qry);
	if($result->num_rows==1)
	{
		echo "<script type='text/javascript'>alert('Login Successfull!');</script>";
		$conn->query("INSERT INTO login VALUES('$email','$pw');");
		if($f==1)
		{
			header("Location:booking.php");
			
		}
		else{
		   
			header("Location:index.php");
		}
		
	}
	else{
		?>
		<script type="text/javascript" language="javascript">
		alert("OOPS! No such account exists, please SIGN UP")
		</script>
		<?php
	}}
}
?>
	<section class="ftco-section">
		<div class="container">
			<h3 align="center"><b></b></h3>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
							    <img src="usericon.png" height=200 width=200>
								<h2>Welcome to login</h2>
								<p>Don't have an account?</p>
								<a href="register.php" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h2 class="mb-4">Sign In</h2>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="https://www.facebook.com/" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="https://twitter.com/" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="login.php" class="signin-form" method="post" onsubmit="return validate()">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email ID</label>
			      			<input type="text" class="form-control" name="email" id="email" placeholder="Username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="pw" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	
									</div>
									<div class="w-50 text-md-left">
										<a href="index.php">GO HOME</a>
									</div>
									<div class="w-50 text-md-right">
										<a href="forgotpswd.php">Forgot Password?</a><br>
	                                </div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

