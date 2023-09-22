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
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
	echo $message;
	}

include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
?>

<div id="main">

		<h2 align="center" class="style1">Change Password</h2>
		<?php		
$username = $_SESSION['USERNAME'];
?>
		<div align="center" class="style1">

		  <table>
		    <form action="changep.php" method="post">
			
	          <td width="115"><em>New Password</em></td><td width="200"><input type="password" name="password" size="20" value= "" /></td></tr><tr></tr>
			  <td width="120"><em>Confirm Password</em></td><td width="200"><input type="password" name="repassword" size="20" value= "" /></td></tr><tr></tr>

			  <tr><td width="100" height="49"></td>
		      <td width="200"><input type="submit" name="submit" value="submit" /></td></tr>
	        </form>
	      </table>
		  <br />
		  </div>
</table>
 <p align="center"><a href="frm0.php">Go Back to Home page</a></p>
</div>