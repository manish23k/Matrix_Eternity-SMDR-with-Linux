<?php
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";

if(isset($_POST['submit']))
{
$eid=$_POST['eid'];
$first=$_POST['name'];
$ext=$_POST['number'];

if ($ext == "" )
{
 echo "<p>Extension cannot be blank</p>"; 
}
else
{
$query="update extension set name = '$first', number = '$ext' WHERE id='$eid'"; 
 $retval = mysqli_query( $query);
}
if(!($retval))
{
  die('Could not enter data: ' . mysqli_error());
}
else
{

header("location:gldir.php");

}
}
?>