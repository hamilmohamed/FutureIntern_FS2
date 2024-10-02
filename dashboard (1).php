<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Employee Management System</title>
    <link rel="stylesheet" href="public/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="public/index.html">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="src/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <h2>Employee Management</h2>
            <a href="add_employee.html">Add New Employee</a>
            <h3>Employees</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'src/config.php';
                    $sql = "SELECT * FROM employees";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['position']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['salary']}</td>
                                <td>
                                    <a href='src/edit_employee.php?id={$row['id']}'>Edit</a> | 
                                    <a href='src/delete_employee.php?id={$row['id']}'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No employees found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
