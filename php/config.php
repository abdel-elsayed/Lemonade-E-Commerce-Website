<?php

session_start();
$SERVER = 'localhost';
$USER = 'root';
$PASS = '';
$DATABASE = 'project';
    
 
$conn = new mysqli($SERVER, $USER, $PASS, $DATABASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>