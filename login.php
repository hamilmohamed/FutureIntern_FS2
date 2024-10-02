<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection
$sql = $conn->prepare("SELECT * FROM users WHERE username=?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the hashed password
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header('Location: ../dashboard.php');
        exit;
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found";
}

$conn->close();
?>
