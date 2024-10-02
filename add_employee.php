<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit;
}

include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$position = $_POST['position'];
$department = $_POST['department'];
$salary = $_POST['salary'];

$sql = "INSERT INTO employees (name, email, position, department, salary) VALUES ('$name', '$email', '$position', '$department', '$salary')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../dashboard.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
