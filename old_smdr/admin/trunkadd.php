<html>
<head>
<title>SMDR reporting</title>
<style type="text/css">
</style>
</head>
 <?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
    header("Location: /smdr/index.php");
    die(); // Terminate script execution
}

// Include necessary files
include_once $_SERVER['DOCUMENT_ROOT'] . "/smdr/config/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/smdr/admin/menu.php";

// Establish database connection
$mysqli = new mysqli("localhost", "cron", "1234", "smdr");
if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $trk = $mysqli->real_escape_string($_POST['trunk']);
    
    // Create and execute the SQL query
    $insertQuery = "INSERT INTO trunks (name, trunk) VALUES ('$name', '$trk')";
    if ($mysqli->query($insertQuery)) {
        header("Location: trunk.php");
        exit(); // Terminate script execution
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>



<body>
<div id="main" style="width:35%;height:35%">
<form id="form1" name="form1" method="post" action="trunkadd.php">
  <h3 align="center">Add New Trunk Details </h3>  
  <table align="center">
    <tr valign="baseline"> 
      <td width="99" align="right" nowrap="">Trunk:</td>
      <td width="194"><input type="text" name="trunk" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap="" align="right">Name:</td>
      <td><input type="text" name="name" value="" size="32"></td>
    </tr>
    <tr valign="baseline"> 
      <td nowrap="" align="right">&nbsp;</td>
      <td><input type="submit" value="submit" name="submit"></td>
       <input type="hidden" name="ExtID" value="1">
    </tr>
  </table>  
</form>
</div>
</body>
</html>
