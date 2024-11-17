<?php
// Inclusion des fichiers nécessaires
require_once "conn.php";
require_once "entr.php";
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$database = Database::getInstance();
$db = $database->getConnection();
$coach = new Coach($db);
$coachId = $_SESSION['user_id'];

// Récupération des données du coach

$coachInfo = $coach->getCoachInfo($coachId);
$diplomes = $coach->getDiplomes($coachId);
$specialisations = $coach->getSpecialisations($coachId);
$carriere = $coach->getCarriere($coachId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Coach</title>
    <link href="css/bootstrap1.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">Interface Coach</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-light" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="images/joueurs_<?php echo $coachInfo['id']; ?>.jpg" alt="<?php echo htmlspecialchars($coachInfo['nom']); ?>" class="rounded-circle mb-3" style="width: 150px;">
                        <h4><?= htmlspecialchars($coachInfo['nom']); ?></h4>
                        <p>Age : <?= htmlspecialchars($coachInfo['age']); ?> ans</p>
                        <p>Nationalité : <?= htmlspecialchars($coachInfo['nationalite']); ?></p>
                        <a href="suiviejoueurs.php" class="btn btn-primary w-100">
                            <i class="fas fa-users me-2"></i> Suivi des Joueurs
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-8">
                <!-- Diplômes -->
                <div class="card mb-4">
                    <div class="card-header">Diplômes</div>
                    <div class="card-body">
                        <?php foreach ($diplomes as $diplome): ?>
                            <p><?= htmlspecialchars($diplome['titre']); ?> - <?= htmlspecialchars($diplome['annee']); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Spécialisations -->
                <div class="card mb-4">
                    <div class="card-header">Spécialisations</div>
                    <div class="card-body">
                        <?php foreach ($specialisations as $spec): ?>
                            <p><?= htmlspecialchars($spec['nom']); ?> (<?= htmlspecialchars($spec['niveau']); ?>%)</p>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Carrière -->
                <div class="card">
                    <div class="card-header">Carrière</div>
                    <div class="card-body">
                        <?php foreach ($carriere as $exp): ?>
                            <p><?= htmlspecialchars($exp['club']); ?> : <?= htmlspecialchars($exp['description']); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Coach Management - Tous droits réservés</p>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
