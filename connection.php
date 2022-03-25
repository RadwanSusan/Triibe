<?php
$servername = $_SERVER['SERVER_NAME'];
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, "root", "", "triibe");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else {
	// echo "Connected successfully" . "<br>";
}