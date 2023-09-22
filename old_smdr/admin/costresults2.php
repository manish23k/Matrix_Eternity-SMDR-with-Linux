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
		<h2 align="center" class="style1">Incoming Calls</h2>
<table border="1" id="opencalls">
  <tr>
    <td nowrap><div align="center"> <font size="2"><strong>Total Calls</strong></font></div></td>


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
$query = "SELECT COUNT(day) FROM incall WHERE $select1 = '$param1' AND $select2 LIKE '$param2'AND $select3 = '$param3' ORDER BY id ASC"; 
$result = mysqli_query($con, $query);
}
else {
$query = "SELECT COUNT(day) FROM incall WHERE $select1 = '$param1'AND $select3 = '$param3' ORDER BY id ASC";
$result = mysqli_query($con, $query);
}

while($row=mysqli_fetch_array($result))  
{ $rowno += 1;  

?>

	<td><div align="center"><font size="3"><?php echo $row['COUNT(day)'];?></font></div></td> 
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
$query = "SELECT * FROM incall WHERE $select1 = '$param1' AND $select2 LIKE '$param2'AND $select3 = '$param3' ORDER BY id ASC"; 
$result = mysqli_query($con, $query);
}
else {
$query = "SELECT * FROM incall WHERE $select1 = '$param1'AND $select3 = '$param3' ORDER BY id ASC";
$result = mysqli_query($con, $query);
}

?>

<body>
<table style=" border:1px solid silver" cellpadding="5px" cellspacing="1px" border="1"> 
  <tr>
    <td nowrap><div align="center"> <font size="2"><strong>Row</strong></font></div></td> 
    <td nowrap><div align="center"> <font size="2"><strong>Year</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Mth</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Day</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Time</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Call Length</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Caller</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Trunk</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Extension</strong></font></div></td>
    <td nowrap><div align="center"> <font size="2"><strong>Call Type</strong></font></div></td>
  </tr>
<?php
while($row = mysqli_fetch_object($result)) {
$rowno += 1; $ccode = ""; $code = ""; $table = ""; $countryprint = ""; $callcost = ""; $codetest = ""; $timetest = "";
$codetest = (substr(($row->calledno),0,1));

//strip ":" from time and check for evening or day rate
//$new_time = ereg_replace("[^A-Za-z0-9]", "", $row->time );
//if ($new_time < '759'){$timetest = 'evening';} else {$timetest = 'cost';}



$extquery = "SELECT `first` FROM `extension` WHERE `extension` = '{$row->calledparty}'";
$extresult = mysqli_query($extquery);
$extprint = mysqli_fetch_array($extresult);
$first = $extprint['first'];

$trimed = preg_replace('/(?<!\w)91|(?<!\w)0091/', '', ($row->callingparty));

$gdquery = "SELECT `name` FROM `gldir` WHERE `number` = '$trimed'";

$gdresult = mysqli_query($gdquery);
$gdprint = mysqli_fetch_array($gdresult);
$gdname = $gdprint['name'];

$tranquery = "SELECT `name` FROM `trunks` WHERE `trunk` = '{$row->calledno}'";
$tranresult = mysqli_query($tranquery);
$tranprint = mysqli_fetch_object($tranresult);
if(!$tranprint) {
$trkname ="";
}
else{
$trkname =($tranprint->name);
}
?>
  <tr> 
    <td><div align="center"><font size="2"><?php echo ($rowno);?></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->year);?></A></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->month);?></A></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->day); ?></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->time);?><?php echo ($row->PM); ?></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->sec); ?></font></div></td>
    <td><div align="center"><font size="2"><?php echo $gdname;?> <?php echo ($row->callingparty);?></font></div></td>
    <td><div align="center"><font size="2"><?php echo ($row->calledno);?> <?php echo "["?><?php echo ($trkname);?><?php echo "]"?></font></div></td>
    <td><div align="center"><font size="2"><?php echo $first;?> <?php echo ($row->calledparty);?></font></div></td>
	<td><div align="center"><font size="2"><?php echo ($row->calltype);?></a></font></div></td>
  </tr>
<?php
}
?>
</table>
</div>
</body>
</html>


