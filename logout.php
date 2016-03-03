<?php
session_start();
if(isset($_SESSION['userlogged']))
{
	require_once 'library/functions.login.php';
	$login=new Login();
	$login->logout($_SESSION["username"]);
	session_destroy();
}
header("Location:dashboard.php");