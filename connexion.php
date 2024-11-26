<?php
$host = 'localhost';
<<<<<<< HEAD
$dbname = 'projetcentreformation';
=======
$dbname = 'Projetg';
>>>>>>> fb1d3916757e51253a73e398aeefcbc495b4175a
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
