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

if(isset($_POST['submit'])){
$eid=$_POST['eid'];
$first=$_POST['name'];
$ext=$_POST['number'];
$update="update gldir set name = '$first', number = '$ext' WHERE id='$eid'"; 
$result = mysqli_query($update);
header("location:gldir.php");
}
else{
$url = $_GET['a'];
}

$query = "SELECT * FROM gldir WHERE id LIKE '$url'"; 
$result = mysqli_query($query);

while($row = mysqli_fetch_object($result)) {
?>
<body>
<div id="main" style="width:35%;height:35%">

<form id="form1" name="form1" method="post" action="dired.php">
  <h3 align="center">Update Global Directory Details </h3>  
<table align="center">
    <tr valign="baseline"> 
      <td width="99" align="right" nowrap>Number:</td>
      <td width="194"><input type="text" name="number" value="<?php echo ($row->number); ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="name" value="<?php echo ($row->name) ?>" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap align="right">&nbsp;</td>
	  <input type="hidden" name="eid" value="<?php echo ($row->id); ?>">
      <td><input type="submit" value="submit" name="submit"></td>

    </tr>
	</table>  
</form>

<?php
}?>
</div>
</body>
</html>