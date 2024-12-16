<?php
// Replace with your database details
$con = mysqli_connect("localhost", "root", "", "profile");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>