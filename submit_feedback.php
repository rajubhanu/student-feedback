<?php
include 'db_connect.php';

$name = $_POST['name'];
$rollno = $_POST['rollno'];
$subject = $_POST['subject'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

$sql = "INSERT INTO feedbacks (name, rollno, subject, rating, comments) 
        VALUES ('$name', '$rollno', '$subject', '$rating', '$comments')";

if ($conn->query($sql) === TRUE) {
    echo "Thank you! Feedback submitted successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
