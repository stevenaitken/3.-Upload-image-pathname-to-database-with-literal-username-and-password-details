<?php
$servername = "127.0.0.1";
$user = "testUser";
$password = "1234";
$db = "register";

// Create connection
$conn = new mysqli($servername, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}


?>

