
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
$_SESSION['admin_mode']=0;
ini_set('display_errors', 'Off');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>railway.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />

<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.ui.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.defaultvalue.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.scrollTo-min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#fullname, #validemail, #message").defaultvalue("Full Name", "Email Address", "Message");
    $('#shout a').click(function () {
        var to = $(this).attr('href');
        $.scrollTo(to, 1200);
        return false;
    });
    $('a.topOfPage').click(function () {
        $.scrollTo(0, 1200);
        return false;
    });
    $("#tabcontainer").tabs({
        event: "click"
    });
});

		
	

</script>
<!-- Homepage Only Scripts -->
<script type="text/javascript" src="layout/scripts/jquery.cycle.min.js"></script>
<script type="text/javascript">
$(function() {
    $('#hpage_slider').after('<div id="fsn"><ul id="fs_pagination">').cycle({
        timeout: 5000,
        fx: 'fade',
        pager: '#fs_pagination',
        pause: 1,
        pauseOnPagerHover: 0
    });
});
</script>
<script type="text/javascript" src="layout/scripts/piecemaker/swfobject/swfobject.js"></script>
<script type="text/javascript">
var flashvars = {};
flashvars.cssSource = "layout/scripts/piecemaker/piecemaker.css";
flashvars.xmlSource = "layout/scripts/piecemaker/piecemaker.xml";
var params = {};
params.play = "false";
params.menu = "false";
params.scale = "showall";
params.wmode = "transparent";
params.allowfullscreen = "true";
params.allowscriptaccess = "sameDomain";
params.allownetworking = "all";
swfobject.embedSWF('layout/scripts/piecemaker/piecemaker.swf', 'piecemaker', '960', '430', '10', null, flashvars, params, null);
</script>

<!-- End Homepage Only Scripts -->
</head>
<body id="top">




<div class="wrapper col2">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index.php">WELCOME  TO  RAILWAY  TICKET  BOOKING</a></h1>
      <p><h5 align="center">HAVE A SAFE JOURNEY WITH US!<h5>
	  </p>
    </div>
    <div id="topnav">

      <ul>
        <li class="last"><a href="login.php">Login</a>
		<ul>
		    <li><a href="register.php">Sign Up</a></li>
            <li><a href="forgotpswd.php">Forgot Password?</a></li>
		</ul>
        <li><a href="#">Customer Care</a>
         <ul>
            <li><a href="report.php">Report a problem</a></li>
            <li><a href="review.php">Customer Review</a></li>
         </ul>
        </li>
		<li><a href="cancellation.php">Cancel Ticket</a></li>
        <li><a href="pnrstatus.php">PNR Status</a></li>
        <li><a href="booking.php">Book & Pay</a></li>
        <li class="active"><a href="package.php">Check Availability</a></li>
      </ul>
	 
	  
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->

<div class="wrapper col3">

  <div id="featured_slide"> 
  <h6 align="left" color="orange"><font color="orange"><?php echo "Today : ".date("d/m/y"); ?></font></h6>
    <div id="piecemaker"><img src="bg3.jpg" alt="couldn't load image" height=360 width=900/></div>
 
  </div>
</div>
<h2><marquee><font color="yellow">BOOK YOUR TICKET ONLINE & STAY SAFE</font></marquee></h2>
<!-- ####################################################################################################### -->

<div class="wrapper col4">
<br><br><table><tr><td>
<h6 align="right"><a href="logout.php"><b>LOG OUT <b></a></h6></td><td></td></tr></table>
  <div id="container" class="clear"> 
    <form method="post" align="right">
	<!--<input type="button" name="btn" onclick="logout()" value="LOG OUT" height="10" width="10">-->
	</form>
	
</div>
</body>
</html>