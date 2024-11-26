<?php
require('connexion.php');

// Handle adding new player
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_player'])) {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $position = $_POST['position'];

    // Insert new player into the database
    $stmt = $pdo->prepare("INSERT INTO joueurs (nom, age, position) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $age, $position]);

    // After insertion, redirect to avoid form resubmission
    header('Location: index.php');
    exit();
}

