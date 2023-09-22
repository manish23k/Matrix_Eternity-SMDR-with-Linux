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

if (isset($_POST['submit'])) {
    $first = $_POST['name'];
    $ext = $_POST['number'];
    $insert = "INSERT INTO gldir (name, number) VALUES ('$first', '$ext')";
    
    $result = mysqli_query($con, $insert); // Use $insert instead of $update
    
    if ($result) {
        header("location:gldir.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<body>
<div id="main" style="width:35%;height:35%">
<form id="form1" name="form1" method="post" action="diradd.php">
  <h3 align="center">Add New Global Directory Details </h3>  
  <table align="center">
    <tr valign="baseline">
      <td width="99" align="right" nowrap>Number:</td>
      <td width="194"><input type="text" name="number" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="name" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="submit" name="submit"></td>
       <input type="hidden" name="ExtID" value="1">
    </tr>
  </table>  
</form>
</div>
</body>
</html>
