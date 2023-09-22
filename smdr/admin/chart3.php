<?php
// Connect to MySQL
session_start();

if (!isset($_SESSION['USERNAME'])) {
     header("Location:/smdr/index.php");
     die();     // just to make sure no scripts execute
}
include_once $_SERVER['DOCUMENT_ROOT']."/smdr/config/config.php";

$mon=date("m");
$m_name=(INT)$mon;
$yr=date("Y");
//$qsc = mysqli_query("SELECT * FROM qscore WHERE o_id LIKE '8' AND y_id LIKE '1'");

// Print out rows
$prefix = '';
$d=cal_days_in_month(CAL_GREGORIAN,$m_name,$yr);
echo "[\n";
for ($day = 1; $day <= $d; $day++){
$in1 = mysqli_query("SELECT COUNT(day) FROM internal WHERE month LIKE $m_name AND day LIKE '$day' AND year LIKE '$yr'");
$in = mysqli_fetch_assoc( $in1 );


  echo $prefix . " {\n";
  echo '  "category": "' . $day . '",' . "\n";
  echo '  "value1": ' . $in['COUNT(day)'] . ',' . "\n";
  echo " }";
  $prefix = ",\n";

}
echo "\n]";
// Close the connection

?>