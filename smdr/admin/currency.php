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

		<h2 align="center" class="style1">Change Currency Symbol</h2>
		<?php		
$username = $_SESSION['USERNAME'];
?>
		<div align="center" class="style1">

		  <table>
		    <form action="changesym.php" method="post">
			
	        <p><strong>Select Currency Symbol</strong> 
      <select name="curcy" size="1">
        <option value="8377">&#8377;</option>
		<option value="36">&#36;</option>
        <option value="163">&#163;</option>
        <option value="128">&#128;</option>
        <option value="162">&#162;</option>
		<option value="165">&#165;</option>
		<option value="8355">&#8355;</option>
      </select>
			  <tr><td width="100" height="49"></td>
		      <td width="200"><input type="submit" name="submit" value="submit" /></td></tr>
	        </form>
	      </table>
		  <br />
		  </div>
</table>
</div>