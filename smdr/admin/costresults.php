<html>
<head>
<title>SMDR reporting</title>
<style type="text/css">
</style>
</head>
</html>
<?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/pm/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/admin/menu.php";
?>
<div id="main" style="overflow-x:scroll;overflow-y:scroll;width:78%;height:90%">
		<h2 align="center" class="style1">Outgoing Calls</h2>
<table border="1" id="opencalls">
  <tr>
    <td nowrap><div align="center"> <font size="-1"><strong>Total Calls</strong></font></div></td>
	<td nowrap><div align="center"> <font size="-1"><strong>Total Cost</strong></font></div></td> 	
  </tr>

<?php
$rowno = 0;
$param3= date("Y");
$select1= $_GET['select']; 
$param1= $_GET['selectvar'];
$select2= $_GET['select2'];
$param2= $_GET['selectvar2'];
$select3= $_GET['select3'];
$param3= $_GET['selectvar3'];
if ($select2 != ''){
$query = "SELECT SUM(cost), COUNT(cost) FROM import WHERE $select1 = '$param1' AND $select2 LIKE '$param2'AND $select3 = '$param3' ORDER BY id ASC"; 
$result = mysqli_query($con, $query);
}
else {
$query = "SELECT SUM(cost), COUNT(cost) FROM import WHERE $select1 = '$param1'AND $select3 = '$param3' ORDER BY id ASC";
$result = mysqli_query($con, $query);
}
$curc1 = mysqli_query("SELECT * FROM currency WHERE id = '1'");
if(! $curc1 )
{
  $curcy = "&#8377;";
}
else
{
$curc2 = mysqli_fetch_array($curc1);
$curcy = "&#".$curc2['curcy'].";";
}

while($row=mysqli_fetch_array($result))  
{ $rowno += 1;  

?>
  <tr>
	<td><div align="center"><font size="-1"><?php echo $row['COUNT(cost)'];?></font></div></td> 
	<td><div align="center"><font size="-1"><?php echo $curcy; ?><?php echo round(($row['SUM(cost)']),2);?></font></div></td>
  </tr>
<?php
}
?>
</table>

<?php
$rowno = 0;
$param3= date("Y");
$select1= $_GET['select']; 
$param1= $_GET['selectvar'];
$select2= $_GET['select2'];
$param2= $_GET['selectvar2'];
$select3= $_GET['select3'];
$param3= $_GET['selectvar3'];
if ($select2 != ''){
$query = "SELECT * FROM import WHERE $select1 = '$param1' AND $select2 LIKE '$param2' AND $select3 = '$param3' ORDER BY id ASC"; 
$result = mysqli_query($con, $query);
}
else {
$query = "SELECT * FROM import WHERE $select1 = '%$param1%'AND $select3 = '%$param3%' ORDER BY id ASC";
$result = mysqli_query($con, $query);
}

?>

<html>
<body>
<table style=" border:1px solid silver" cellpadding="5px" cellspacing="1px" border="1">  
  <tr>
    <td nowrap><div align="center"> <font size="-1"><strong>Row</strong></font></div></td> 
    <td nowrap><div align="center"> <font size="-1"><strong>Called Party</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Trunk</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Extension</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Acc. Code</strong></font></div></td>	
	<td nowrap><div align="center"> <font size="-1"><strong>Call Length</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Call Cost</strong></font></div></td>
	<td nowrap><div align="center"> <font size="-1"><strong>Call Type</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Time</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Day</strong></font></div></td>
    <td nowrap><div align="center"> <font size="-1"><strong>Mth</strong></font></div></td>	
    <td nowrap><div align="center"> <font size="-1"><strong>Year</strong></font></div></td>
  </tr>

<?php
while($row = mysqli_fetch_object($result)) {
$rowno += 1; $ccode = ""; $code = ""; $table = ""; $countryprint = ""; $callcost = ""; $codetest = ""; $timetest = "";
$codetest = (substr(($row->calledno),0,1));


$extquery = "SELECT `first` FROM `extension` WHERE `extension` = '{$row->calledparty}'";
$extresult = mysqli_query($extquery);
$extprint = mysqli_fetch_array($extresult);
$first = $extprint['first'];

$trimed = preg_replace('/(?<!\w)0|(?<!\w)00/', '', ($row->calledno));

$gdquery = "SELECT `name` FROM `gldir` WHERE `number` = '$trimed'";
#$gdquery = "SELECT `name` FROM `gldir` WHERE `number` = '{$row->calledno}'";
$gdresult = mysqli_query($gdquery);
$gdprint = mysqli_fetch_array($gdresult);
$gdname = $gdprint['name'];

$tranquery = "SELECT `name` FROM `trunks` WHERE `trunk` = '{$row->callingparty}'";
$tranresult = mysqli_query($tranquery);
$tranprint = mysqli_fetch_object($tranresult);
if(!$tranprint) {
$trkname ="";
}
else{
$trkname =($tranprint->name);
}

$acquery = "SELECT `name` FROM `accountcode` WHERE `accountcode` = '{$row->acccode}'";
$acresult = mysqli_query($acquery);
$acprint = mysqli_fetch_object($acresult);

?>
  <tr> 
    <td><div align="center"><font size="-1"><?php echo ($rowno);?></font></div></td>
    <td><div align="center"><font size="-1"><?php echo $gdname;?> <?php echo ($row->calledno);?></font></div></td>
    <td><div align="center"><font size="-1"><?php echo ($row->callingparty);?> <?php echo "["?><?php echo ($trkname);?><?php echo "]"?></font></div></td>
    <td><div align="center"><font size="-1"><?php echo $first;?> <?php echo ($row->calledparty);?></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($acprint->name);?> <?php echo ($row->acccode);?></font></div></td>
    <td><div align="center"><font size="-1"><?php echo ($row->sec); ?></font></div></td>
	<td><div align="center"><font size="-1"><?php echo $curcy." "?><?php echo ($row->cost);?></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($row->calltype);?></a></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($row->time);?><?php echo ($row->PM); ?></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($row->day); ?></A></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($row->month);?></A></font></div></td>
	<td><div align="center"><font size="-1"><?php echo ($row->year);?></A></font></div></td>	
  </tr>
  <?php
}
?>
</table>
  </div>
</body>
</html>


