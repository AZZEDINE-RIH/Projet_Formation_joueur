<?php
require 'connexion.php';


// Fetch center members based on a specific centre_id
$centreId = 1; // Set this to any centre ID or make it dynamic
$query = $pdo->prepare("SELECT * FROM members WHERE centre_id = :centre_id");
$query->bindParam(':centre_id', $centreId, PDO::PARAM_INT);
$query->execute();
$members = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if member ID is provided for deletion
if (isset($_GET['id'])) {
    $memberId = $_GET['id'];

    // Delete member query
    $query = $pdo->prepare("DELETE FROM members WHERE id = :id");
    $query->bindParam(':id', $memberId, PDO::PARAM_INT);
    $query->execute();

    // Redirect to the admin dashboard after deletion
    header('Location: Admin.php');
    exit();
}

// Fetch statistics
$totalPlayers = $pdo->query("SELECT COUNT(*) FROM joueurs")->fetchColumn();
$activeFormations = $pdo->query("SELECT COUNT(*) FROM formations WHERE status = 'active'")->fetchColumn();
$totalAdmins = $pdo->query("SELECT COUNT(*) FROM admins WHERE status = 'active'")->fetchColumn();
$validatedDocsPercentage = 75;

// Fetch player data
$stmt = $pdo->query("SELECT * FROM joueurs");
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle adding new player
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_player'])) {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $position = $_POST['position'];

    // Insert new player into the database
    $stmt = $pdo->prepare("INSERT INTO joueurs (nom, age, position) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $age, $position]);

    // After insertion, redirect to avoid form resubmission
    header('Location: Admin.php');
    exit();
}

if (isset($_GET['delete_player'])) {
    $playerId = $_GET['delete_player'];
    $stmt = $pdo->prepare("DELETE FROM joueurs WHERE id = ?");
    $stmt->execute([$playerId]);

    // After deletion, redirect to avoid resending the GET request
    header('Location: Admin.php');
    exit();
}

// Handle adding new member
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $memberName = $_POST['member_name'];
    $memberEmail = $_POST['member_email'];

    // Insert new member into the database
    $stmt = $pdo->prepare("INSERT INTO members (nom, email, centre_id) VALUES (?, ?, ?)");
    $stmt->execute([$memberName, $memberEmail, $centreId]);

    // After insertion, redirect to avoid form resubmission
    header('Location: Admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Gestion des Formations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styleAdmin.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center py-3">Admin Dashboard</h3>
        <a href="#dashboard">Tableau de bord</a>
        <a href="#gestion-joueurs">Gestion des Joueurs</a>
        <a href="#gestion-membres">Gestion des Membres</a>
        <a href="#securite">Sécurité</a>
        <a href="#rapports">Rapports</a>
        <a href="#parametres">Paramètres</a>
        <a href="#deconnexion" class="text-danger">Déconnexion</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar (Header Section) -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Dashboard Administrateur</span>
                <button class="btn btn-outline-danger" onclick="window.location.href='logout.php'">Déconnexion</button>
            </div>
        </nav>

        <!-- Dashboard Stats -->
        <section id="dashboard" class="mt-4">
            <h4>Vue Générale</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-custom shadow-sm p-3">
                        <h5>Joueurs</h5>
                        <p class="mb-0">Total : <b><?php echo $totalPlayers; ?></b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom shadow-sm p-3">
                        <h5>Formations</h5>
                        <p class="mb-0">Sessions actives : <b><?php echo $activeFormations; ?></b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom shadow-sm p-3">
                        <h5>Administrateurs</h5>
                        <p class="mb-0">Actifs : <b><?php echo $totalAdmins; ?></b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom shadow-sm p-3">
                        <h5>Documents</h5>
                        <p class="mb-0">Validés : <b><?php echo $validatedDocsPercentage; ?>%</b></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gestion des Joueurs -->
        <section id="gestion-joueurs" class="mt-4">
            <h4>Gestion des Joueurs</h4>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPlayerModal">Ajouter un Joueur</button>

            <!-- Table of Players -->
            <div class="table-responsive">
                <table class="table table-dark table-hover" id="joueursTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Âge</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($players as $index => $player): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($player['nom']); ?></td>
                                <td><?php echo htmlspecialchars($player['age']); ?></td>
                                <td><?php echo htmlspecialchars($player['position']); ?></td>
                                <td>
                                    <a href="?delete_player=<?php echo $player['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Gestion des Membres du Centre -->
        <section id="gestion-membres" class="mt-4">
            <h4>Gestion des Membres du Centre</h4>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Ajouter un Membre</button>

            <!-- Table of Members -->
            <div class="table-responsive">
                <table class="table table-dark table-hover" id="membresTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $index => $member): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($member['nom']); ?></td>
                                <td><?php echo htmlspecialchars($member['email']); ?></td>
                                <td>
                                    <a href="?id=<?php echo $member['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Modal for Adding Player -->
    <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlayerModalLabel">Ajouter un Joueur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Âge</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="add_player">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Member -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="member_name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="member_name" name="member_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="member_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="member_email" name="member_email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="add_member">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
