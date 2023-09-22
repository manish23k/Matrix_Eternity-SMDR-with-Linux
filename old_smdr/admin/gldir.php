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

$query = "SELECT * FROM gldir ORDER BY name ASC"; 
$result = mysqli_query($con, $query);

?>


<body>
<div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%">
		<h2 align="center" class="style1">Directory</h2>
<table border="1" id="extensions">
  <tr>
    <td nowrap><div align="center"> <font size="-1"><strong>Sr. No</strong></font></div></td> 
    <td nowrap><div align="center"> <font size="-1"><strong>Number <a href='diradd.php'> New</a></strong></font></div></td> 
    <td nowrap><div align="center"> <font size="-1"><strong>Name <a href='dirimport.php'> Import</a></strong></font></div></td>
  </tr>
  <?php
$rowno = 0;
while($row = mysqli_fetch_object($result)) {
$rowno += 1;
?>
  <tr>
    <td><div align="center"><font size="-1"><?php echo $rowno; ?></font></div></td>
    <td><div align="center"><font size="-1"><a href='dired.php?a=<?php echo($row->id);?> '><?php echo ($row->number);?></a></font></div></td>
    <td><div align="center"><font size="-1"><?php echo ($row->name);?></A></font></div></td>
  </tr>
  <?php
  }
?>
</table>
<?php

?>

</body>
</div>
</html>
