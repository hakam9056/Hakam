<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Condo Listings</title>
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
        .message {
            text-align: center;
            margin-top: 2rem;
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

<h1>Register Your Condo Preferences</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "condohakam";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $size = htmlspecialchars($_POST['size']);
    $budget = htmlspecialchars($_POST['budget']);

    $stmt = $conn->prepare("INSERT INTO users (name, email, location, size, budget) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $email, $location, $size, $budget);

    if ($stmt->execute()) {
        echo "<div class='message'>Registration successful! Thank you for registering.</div>";
    } else {
        echo "<div class='message'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<form action="register.php" method="POST">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    
    <label for="location">Preferred Location</label>
    <input type="text" id="location" name="location" required>
    
    <label for="size">Condo Size (e.g., 1500 sqft)</label>
    <input type="text" id="size" name="size" required>
    
    <label for="budget">Budget ($)</label>
    <input type="number" id="budget" name="budget" step="0.01" required>
    
    <button type="submit">Submit</button>
</form>

<footer>
    &copy; 2024 Condo Listings. All rights reserved.
</footer>

</body>
</html>
