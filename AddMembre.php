<?php
require('connexion.php');

// Fetch center members based on a specific id

$query = $pdo->prepare("SELECT * FROM members  ");
// $query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$members = $query->fetchAll(PDO::FETCH_ASSOC);



// Handle adding new member
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $memberName = $_POST['member_name'];
    $memberEmail = $_POST['member_email'];
    $memberMetier=$_POST['member_Metier'];

    // Insert new member into the database
    $stmt = $pdo->prepare("INSERT INTO members (nom, email,metier) VALUES (?, ?,?)");
    $stmt->execute([$memberName, $memberEmail,$memberMetier]);

    // After insertion, redirect to avoid form resubmission
    header('Location: Admins.php');
    exit();
}