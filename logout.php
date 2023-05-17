<?php
session_start();
ini_set('display_errors', 'Off');
session_unset();
session_destroy();
header("Location:login.php");
?>

