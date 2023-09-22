<?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";
?>

<?php 
if(isset($_POST['submit']))
{

$username = $_SESSION['USERNAME'];
$curcy = $_POST['curcy'];
var_dump($curcy);
$query="update currency set curcy = $curcy"; 
 $retval = mysqlii_query($con, $query);
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error());
}
else
{
echo "Currency Symbol Changed successfully\n";
header("location:home.php");
}
}
?>