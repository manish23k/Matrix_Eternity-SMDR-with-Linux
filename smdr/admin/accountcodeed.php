<!DOCTYPE html>
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

if(isset($_POST['submit'])){
    $eid = $_POST['eid'];
    $accountcode = $_POST['accountcode'];
    $name = $_POST['name'];
    $update = "UPDATE accountcode SET accountcode = '$accountcode', name = '$name' WHERE id = '$eid'";
    $result = mysqli_query($con, $update); // Change $query to $update
    header("location:accountcodelist.php");
}
else{
    $url = $_GET['a'];
}

$query = "SELECT * FROM accountcode WHERE id = $url"; 
$result = mysqli_query($con, $query);
?>

<body>
<div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%">
<?php
while($row = mysqli_fetch_object($result)) { // Change mysql_fetch_object() to mysqli_fetch_object()
?>
<form id="form1" name="form1" method="post" action="accountcodeed.php">
  <h3 align="center">Update Account Code Details </h3>  
  <table align="center">
    <tr valign="baseline"> 
      <td width="99" align="right" nowrap><strong>Account Code:</strong></td>
      <td width="194"><input type="text" name="accountcode" value="<?php echo ($row->accountcode); ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right"><strong>Name:</strong></td>
      <td><input type="text" name="name" value="<?php echo ($row->name) ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="submit" name="submit"></td>
       <input type="hidden" name="eid" value="<?php echo ($row->id); ?>">
    </tr>
  </table>  
</form>
<?php
}
?>
</div>
</body>
</html>
