<?php
require('connexion.php');


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $metier = $_POST['metier'] ?? '';
    $image = $_FILES['image'] ?? null;

    // Validate inputs
    if (empty($name) || empty($email) || empty($metier) || !$image) {
        die("All fields are required!");
    }

    // Handle file upload
    $uploadDir = 'images/icon/'; // Ensure this directory exists and is writable
    $imagePath = $uploadDir . basename($image['name']);
    $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

    // Validate the uploaded file
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        die("Invalid file format! Only JPG, JPEG, PNG, and GIF are allowed.");
    }
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        die("Failed to upload the image.");
    }

    // Insert data into the database
    $sql = "INSERT INTO members (nom, email, metier, image) VALUES (:name, :email, :metier, :image)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':metier' => $metier,
            ':image' => $imagePath,
        ]);
    header('location:index.php');
    } catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
}