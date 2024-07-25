<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - Condo Listings</title>
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
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
        }
        input, select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
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

<h1>Update User</h1>

<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT name, email, location, size, budget FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $location, $size, $budget);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $size = htmlspecialchars($_POST['size']);
    $budget = htmlspecialchars($_POST['budget']);

    $sql = "UPDATE users SET name=?, email=?, location=?, size=?, budget=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdi", $name, $email, $location, $size, $budget, $id);

    if ($stmt->execute()) {
        echo "<p>User updated successfully!</p>";
    } else {
        echo "<p>Error updating user: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
    
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
    <label for="location">Preferred Location</label>
    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" required>
    
    <label for="size">Condo Size (e.g., 1500 sqft)</label>
    <input type="text" id="size" name="size" value="<?php echo htmlspecialchars($size); ?>" required>
    
    <label for="budget">Budget ($)</label>
    <input type="number" id="budget" name="budget" step="0.01" value="<?php echo htmlspecialchars($budget); ?>" required>
    
    <button type="submit">Update</button>
</form>

<footer>
    &copy; 2024 Condo Listings. All rights reserved.
</footer>

</body>
</html>