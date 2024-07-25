<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p>User deleted successfully!</p>";
    } else {
        echo "<p>Error deleting user: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<p><a href="read.php">Go back to the list</a></p>
