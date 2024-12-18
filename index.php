<?php
// player_data.php

// Include the configuration file for database connection
require_once 'config.php';

// Fetch player data securely
$player_id = 1; // Example: Fetch player with ID 1
$stmt = $conn->prepare("SELECT * FROM player WHERE id = ?");
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if data exists
$profile = $result->num_rows > 0 ? $result->fetch_assoc() : null;

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PROFILE - <?php echo htmlspecialchars($profile['name'] ?? 'Player'); ?></title>
  <meta name="description" content="Player profile at FJM Football Academy">
  <meta name="keywords" content="football, player, academy, profile">

  <!-- Favicons -->
  <link href="assets/img/R.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <img src="assets/img/R.png" alt="Logo"> 
        <h1 class="sitename">FJM</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#aceuil" class="active">Home</a></li>
          <li><a href="#hero">Profile</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Suivi Medical</a></li>
          <li><a href="#contact">Planning</a></li>
          <li><a href="#team">Entraineur</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="logout.php">Déconnection</a>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="<?php echo htmlspecialchars($profile['profile_image'] ?? 'assets/img/jm.jpg'); ?>" alt="Player Image" data-aos="fade-in">
      <div class="container">
        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-6 col-lg-8">
            <h2>Welcome <?php echo htmlspecialchars($profile['name'] ?? 'Player'); ?><span>.</span></h2>
            <p>Centre de formation de football marocain</p>
          </div>
        </div>

        <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-xl-4 col-md-4">
            <div class="icon-box">
              <i class="bi bi-bullseye"></i>
              <h3><a href="">About You</a></h3>
            </div>
          </div>
          <div class="col-xl-4 col-md-4">
            <div class="icon-box">
              <i class="bi bi-fullscreen-exit"></i>
              <h3><a href="">Voir Votre Emploi</a></h3>
            </div>
          </div>
          <div class="col-xl-4 col-md-4">
            <div class="icon-box">
              <i class="bi bi-card-list"></i>
              <h3><a href="">Suivi Medical</a></h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 player-image" data-aos="fade-right">
            <img src="<?php echo htmlspecialchars($profile['full_image'] ?? 'assets/img/hakimi-HD.png'); ?>" alt="Player" class="img-fluid rounded-4 shadow-lg">
          </div>
          <div class="col-lg-6 player-details" data-aos="fade-left">
            <div class="section-title">
              <h2>Player Profile</h2>
              <p class="fst-italic">Player for GFJM Football Academy</p>
            </div>
            <div class="player-bio">
              <h3 class="mb-3"><?php echo htmlspecialchars($profile['name'] ?? 'Player Name'); ?></h3>
              <ul class="player-stats list-unstyled">
                <li><strong>Age:</strong> <?php echo htmlspecialchars($profile['age'] ?? 'N/A'); ?> years old</li>
                <li><strong>Position:</strong> <?php echo htmlspecialchars($profile['position'] ?? 'N/A'); ?></li>
                <li><strong>Height:</strong> <?php echo htmlspecialchars($profile['height'] ?? 'N/A'); ?> cm</li>
                <li><strong>Weight:</strong> <?php echo htmlspecialchars($profile['weight'] ?? 'N/A'); ?> KG</li>
                <li><strong>Hometown:</strong> <?php echo htmlspecialchars($profile['hometown'] ?? 'N/A'); ?></li>
              </ul>
              <div class="player-quote mt-3">
                <blockquote class="blockquote">
                  <p>"<?php echo htmlspecialchars($profile['quote'] ?? 'My dream is to represent my team'); ?>"</p>
                  <footer class="blockquote-footer">- Player Dream</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer dark-background">
    <div class="container">
      <p>&copy; 2024 FJM Football Academy. All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
