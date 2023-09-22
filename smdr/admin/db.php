
<?php
// Database configuration
$host = "localhost"; // Change to your database host
$username = "cron"; // Change to your database username
$password = "1234"; // Change to your database password
$database = "smdr"; // Change to your database name

// Create a MySQLi connection
$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}
?>
