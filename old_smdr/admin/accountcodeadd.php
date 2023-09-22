<html>
<head>
<title>SMDR reporting</title>
<style type="text/css">
</style>
</head>
<?php
session_start();
if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
if (isset($_POST['submit'])){
$accountcode=$_POST['accountcode'];
$name=$_POST['name'];
$update = "INSERT INTO accountcode SET accountcode = '$accountcode', name = '$name'";
$result = mysqli_query($con, $update);
header("location:accountcodelist.php");
}
?>

<body>
<div id="main" style="width:35%;height:35%">
<form id="form1" name="form1" method="post" action="accountcodeadd.php">
  <h3 align="center">Add Account Code Details </h3>  
  <table align="center">
    <tr valign="baseline"> 
      <td nowrap align="right">Account Code:</td>
      <td><input type="text" name="accountcode" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Company Name:</td>
      <td><input type="text" name="name" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="submit" name="submit"></td>
       <input type="hidden" name="AccNo" value="1">
    </tr>
  </table>  
</form>
</div>
</body>
</html>
