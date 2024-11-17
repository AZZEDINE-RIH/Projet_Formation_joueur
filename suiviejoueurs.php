<?php
require_once 'conn.php';
require_once 'joueurs.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$playerManager = new Player();

// Récupération du filtre
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Récupération de la recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Récupération des statistiques
$stats = $playerManager->getStatistics();

// Récupération des joueurs
$players = $playerManager->getAllPlayers($filter);

// Filtrage par recherche si nécessaire
if ($search) {
    $players = array_filter($players, function($player) use ($search) {
        return stripos($player['nom'], $search) !== false;
    });
}

// Configuration de la pagination
$players_per_page = 4;
$total_players = count($players);
$total_pages = ceil($total_players / $players_per_page);
$current_page = isset($_GET['page']) ? max(1, min($total_pages, intval($_GET['page']))) : 1;
$offset = ($current_page - 1) * $players_per_page;

// Récupérer seulement les joueurs de la page courante
$players_page = array_slice($players, $offset, $players_per_page);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Joueurs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-futbol"></i> Gestion Joueurs
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
<div class="container-fluid" id="suivie">
        <div class="d-flex justify-content-between align-items-center">
            <div class="m-2">
                <h1>Suivi des Joueurs</h1>
                <p class="mb-0">Tableau de bord de performance</p>
            </div>
            <a href="entraineur.php" class="btn btn-light m-2">
                <i class="fas fa-arrow-left me-2"></i>Retour au profil
            </a>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="quick-stats">
        <div class="row text-center">
            <div class="col-md-3">
                <h4><?php echo $stats['active_players']; ?></h4>
                <p class="mb-0">Joueurs actifs</p>
            </div>
            <div class="col-md-3">
                <h4><?php echo $stats['injured_players']; ?></h4>
                <p class="mb-0">Blessés</p>
            </div>
            <div class="col-md-3">
                <h4><?php echo $stats['avg_performance']; ?>%</h4>
                <p class="mb-0">Performance moyenne</p>
            </div>
            <div class="col-md-3">
                <h4><?php echo $stats['upcoming_matches']; ?></h4>
                <p class="mb-0">Prochains matchs</p>
            </div>
        </div>
    </div>
<br>
    <!-- Filtres avancés -->
    <div class="filter-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <form action="" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un joueur..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="btn-group w-100">
                    <a href="?filter=all" class="btn btn-outline-primary <?php echo $filter === 'all' ? 'active' : ''; ?>">Tous</a>
                    <a href="?filter=active" class="btn btn-outline-success <?php echo $filter === 'active' ? 'active' : ''; ?>">Actifs</a>
                    <a href="?filter=blessee" class="btn btn-outline-danger <?php echo $filter === 'blessee' ? 'active' : ''; ?>">Blessés</a>
                    <a href="?filter=repos" class="btn btn-outline-warning <?php echo $filter === 'repos' ? 'active' : ''; ?>">En repos</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($players_page as $player): ?>
            <div class="col-md-6 mb-3">
                <div class="card player-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="images/joueurs_<?php echo $player['id']; ?>.jpg"  
                                     alt="<?php echo htmlspecialchars($player['nom']); ?>" 
                                     class="player-img">
                            </div>
                            <div class="col">
                                <h5 class="card-title mb-1">
                                    <span class="status-indicator status-<?php echo $player['status']; ?>"></span>
                                    <?php echo htmlspecialchars($player['nom']); ?>
                                </h5>
                                <p class="card-text text-muted mb-2"><?php echo htmlspecialchars($player['position']); ?></p>
                                
                                <div class="mt-3">
                                    <div class="stat-label">Condition physique</div>
                                    <div class="progress">
                                        <div class="progress-bar <?php echo getProgressBarColor($player['physical_condition']); ?>" 
                                             style="width: <?php echo $player['physical_condition']; ?>%"></div>
                                    </div>

                                    <div class="stat-label mt-2">Performance</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" 
                                             style="width: <?php echo $player['performance']; ?>%"></div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="performance-trend <?php echo getPerformanceTrendClass($player['changement_performance']); ?>">
                                            <?php echo formatPerformanceTrend($player['changement_performance']); ?>
                                        </span>
                                        <a href="detail.php?id=<?php echo $player['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-chart-line me-1"></i>Détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <nav aria-label="Navigation des pages">
        <ul class="pagination justify-content-center">
            <!-- Bouton Précédent -->
            <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>" aria-label="Précédent">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Numéros des pages -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Bouton Suivant -->
            <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>" aria-label="Suivant">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<?php
function getProgressBarColor($value) {
    if ($value >= 80) return 'bg-success';
    if ($value >= 50) return 'bg-warning';
    return 'bg-danger';
}

function getPerformanceTrendClass($change) {
    if ($change > 0) return 'trend-up';
    if ($change < 0) return 'trend-down';
    return '';
}

function formatPerformanceTrend($change) {
    if ($change > 0) {
        return '<i class="fas fa-arrow-up"></i> +' . abs($change) . '% cette semaine';
    } elseif ($change < 0) {
        return '<i class="fas fa-arrow-down"></i> -' . abs($change) . '% cette semaine';
    }
    return '<i class="fas fa-equals"></i> Stable';
}
?>
<footer class="bg-dark text-white mt-4">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">© 2024 Gestion des Joueurs. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="privacy.php" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
                <a href="terms.php" class="text-white text-decoration-none">Conditions d'utilisation</a>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>