
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";

include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
?>

		<div id="main">	
		<h2 align="center" class="style1">More Parameters</h2>
		<h5>
	<!-- <li align="left"><a href="currency.php">Currency symbol</a></li> -->
	<li align="left"><a href="editpsw.php">Change Password</a> </li>
		  <br />
		  </div> 