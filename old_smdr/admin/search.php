<html>
<head>
<title>Search page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
?>

<body>
<div id="main" style="overflow: auto;">
		<h2 align="center" class="style1">Search Outgoing Calls</h2>
<form action="costresults.php" method="get" name="Seach form">
    <p align="left">&nbsp;</p>
    <p><strong>Select search field:</strong> 
      <select name="select" size="1">
        <option value="month">Month (in digits)</option>
        <option value="day">Day (in digits)</option>
        <option value="calledno">Called Number</option>
        <option value="callingparty">Trunk</option>
        <option value="calledparty">Extension</option>
		<option value="acccode">Acc.Code</option>
		<option value="calltype">Call Type</option>
        <option value="hrs">Time (Hour of day only)</option>
      </select>
      <strong>Enter parameter:</strong> 
      <input name="selectvar" type="text" id="selectvar" size="10" value=<?php echo (int)date("m") ?>>
    </p>
    <p><strong>Select second field:</strong> 
      <select name="select2" size="1">
        <option value="day">Day (in digits)</option>
	    <option value="month">Month (in digits)</option>		
        <option value="calledno">Called Number</option>
        <option value="callingparty">Trunk</option>
        <option value="calledparty">Extension</option>
		<option value="acccode">Acc.Code</option>
		<option value="calltype">Call Type</option>
        <option value="hrs">Time (Hour of day only)</option>
		<option value=""></option>
      </select>
      <strong>Enter parameter:</strong> 
      <input name="selectvar2" type="text" id="selectvar2" size="10" value=<?php echo (int)date("d") ?>>
    </p>
        <p><strong> Change from current year: </strong> 
      <select name="select3" size="1">
        <option value="year">Year (in digits)</option>
      </select>
      <strong>Enter parameter:</strong>
      <input name="selectvar3" type="text" id="selectvar3" size="10" value=<?php echo date("Y") ?>>
    </p>
    <p> 
      <input type="submit" name="Submit" value="Search">
    </p>
  </form>
</div>
<strong>Please note all reports default to the current year unless otherwise specified</strong>
</body>
</html>