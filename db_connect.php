<?php
$host = "db4free.net";
$user = "rajubhanu"; // your username
$pass = "Rajubhanu@12"; // same as you gave
$db   = "student_feedback";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
