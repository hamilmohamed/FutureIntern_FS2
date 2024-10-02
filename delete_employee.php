<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit;
}

include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM employees WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: ../dashboard.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
