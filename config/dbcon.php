<?php
// Database connection configuration
define('DB_SERVER', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "pos_system_db");

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Uncomment the line below to confirm successful connection
    // echo "Connected successfully";
}

?>