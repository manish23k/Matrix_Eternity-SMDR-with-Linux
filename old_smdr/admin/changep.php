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
$password = $_POST['password'];
$repassword = $_POST['repassword'];

if ($password != '')
{
if($_POST['password'] != $_POST['repassword']){ 
   echo "Your passwords did not match."; 
header("location:editpsw.php?message=Confirm Password not matched");
} 

$query="update smdr_users set password= md5('$password') WHERE username='$username'"; 
 $retval = mysqli_query($con, $query);
if(! $retval )
{
  die('Could not enter data: ' . mysqli_error());
}
else
{
echo "Password Changed successfully\n";
header("location:search.php");
}
}
else
{
echo "Blank Password Not Alloweds";
header("location:editpsw.php?message=Blank Password Not Allowed");
}
}
?>