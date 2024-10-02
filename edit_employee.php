<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit;
}

include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM employees WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $update_sql = "UPDATE employees SET name='$name', email='$email', position='$position', department='$department', salary='$salary' WHERE id='$id'";
    if ($conn->query($update_sql) === TRUE) {
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - Employee Management System</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../public/index.html">Home</a></li>
                <li><a href="../dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="edit-employee">
            <h2>Edit Employee</h2>
            <form action="edit_employee.php?id=<?php echo $id; ?>" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                <label for="position">Position:</label>
                <input type="text" id="position" name="position" value="<?php echo $row['position']; ?>" required>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>" required>
                <label for="salary">Salary:</label>
                <input type="number" id="salary" name="salary" value="<?php echo $row['salary']; ?>" required>
                <button type="submit">Update Employee</button>
            </form>
        </section>
    </main>
</body>
</html>
