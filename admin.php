<?php
session_start();
$_SESSION['admin_mode']=1;
ini_set('display_errors', 'Off');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript">
function logout()
{
	var log=confirm("Do you want to Log out?");
	if(log)
	{
		<?php
		session_unset();
		session_destroy();
		?>
		window.location = 'http://localhost/photoprowess/login.php';
	}
}
</script>
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

</head>
<body id="top">


<div class="wrapper col2">
  <div id="header" class="clear">
    <div class="fl_left">
      <p><h1><a href="index.php">WELCOME ADMIN</a></h1>
	  <p></p>
	  <h8 align="left" color="orange"><?php echo "Today : ".date("d/m/y"); ?></h8>
    </div></p>
    <div id="topnav">
	<font color="blue">
      <ul>
        <li class="last"><a href="ticketmngmt.php">Manage Tickets</a></li>
        <li><a href="reveiwadmin.php">Reviews</a>
		<ul>
		<li><a href="reportadmin.php">Watch Reports</a></li>
        <li><a href="deletetrain.php">Delete Train</a></li>
      </ul>
        
        </li>
		<li><a href="usermngmt.php">Manage Users</a>
		<li><a href="ticket.php">Manage Trains</a>
		<ul>
		<li><a href="addtrain.php">Add Train</a></li>
        <li><a href="deletetrain.php">Delete Train</a></li>
      </ul>
	  </font>
    </div>
  </div>
</div>
<div class="wrapper col3">
  <div id="featured_slide"> 
	
    <div id="piecemaker"><img src="bg3.jpg" alt="couldn't load image" height=400 width=900/></div>
	
  
  </div>
</div>

<div class="wrapper col4">
  <div id="container" class="clear"> 
    <form method="post" align="right"><b>
	<input type="button" name="btn" onclick="logout()" value="LOG OUT" height="10" width="10"></b>
	</form>
	
</div>
</body>
</html>