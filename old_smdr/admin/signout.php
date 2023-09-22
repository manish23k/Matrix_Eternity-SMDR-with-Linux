<?php
session_start();
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
#session_register("USERNAME");
$_SESSION['username'] = $$username;
#session_register("PASSWORD");
$_SESSION['password'] = $$password;
session_destroy();
header("Location: /smdr/index.php");
?>
