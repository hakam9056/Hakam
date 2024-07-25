<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users and Condo Preferences</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 2rem;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-bottom: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 1rem;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        .actions a {
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        .actions .update {
            background-color: #4CAF50;
        }
        .actions .delete {
            background-color: #f44336;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<h1>Registered Users and Their Condo Preferences</h1>

<?php
$servername = "127.0.0.1:3307";
$username = "root@";
$password = "";
$dbname = "condohakam";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, location, size, budget FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Location</th><th>Size</th><th>Budget</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["location"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["size"]) . "</td>";
        echo "<td>$" . number_format($row["budget"], 2) . "</td>";
        echo "<td class='actions'>";
        echo "<a class='update' href='update.php?id=" . $row["id"] . "'>Update</a>";
        echo "<a class='delete' href='delete.php?id=" . $row["id"] . "'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No registered users found.</p>";
}

$conn->close();
?>

<footer>
    &copy; 2024 Condo Listings. All rights reserved.
</footer>

</body>
</html>
