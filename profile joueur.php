<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "player_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Fetch player information
$player_id = 1; // Example player ID

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM players WHERE id = ?");
$stmt->bind_param("i", $player_id);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $name = htmlspecialchars($row['name']);
    $age = htmlspecialchars($row['age']);
    $position = htmlspecialchars($row['position']);
    $height = htmlspecialchars($row['height']);
    $weight = htmlspecialchars($row['weight']);
    $hometown = htmlspecialchars($row['hometown']);
    $dream = htmlspecialchars($row['dream']);
    $achievement_title = htmlspecialchars($row['achievement_title']);
    $best_player = htmlspecialchars($row['best_player']);
    $achievement_3 = htmlspecialchars($row['achievement_3']);
    $achievement_4 = htmlspecialchars($row['achievement_4']);
} else {
    $name = "Player";
    $age = "N/A";
    $position = "N/A";
    $height = "N/A";
    $weight = "N/A";
    $hometown = "N/A";
    $dream = "No dream found.";
    $achievement_title = "No title found.";
    $best_player = "Not chosen as best player.";
    $achievement_3 = "No achievement found.";
    $achievement_4 = "No achievement found.";
}

$medical_status = "No medical status available.";
$trainers = "No trainers available.";

// Close statement and connection
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PROFILE</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/R (1).png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
        <img src="assets/img/R (1).png" alt="" href="https://frmf.ma/"> 
        <h1 class="sitename">FJM</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#aceuil" class="active">Home<br></a></li>
          <li><a href="#hero">PROFILE</a></li>
          <li><a href="#about">about</a></li>
          <li><a href="#services">suivi medical</a></li>
          <li><a href="#contact">Planning</a></li>
          <li><a href="#team">entraineur</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about">déconnection</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="assets/img/jm.jpg" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-6 col-lg-8">
          <h2>Welcome to your profile <span><?php echo $name; ?></span></h2>
            <p>centre de formation de football marocain</p>
          </div>
        </div>
        <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <i class="bi bi-bullseye"></i>
              <h3><a href="">about you</a></h3>
            </div>
          </div>
          <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <i class="bi bi-fullscreen-exit"></i>
              <h3><a href="">voire votre emploi</a></h3>
            </div>
          </div>
          <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="600">
            <div class="icon-box">
              <i class="bi bi-card-list"></i>
              <h3><a href="">suivi medical</a></h3>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 player-image" data-aos="fade-right">
            <img src="assets/img/hakimi-HD.png" alt="<?php echo $name; ?>" class="img-fluid rounded-4 shadow-lg">
          </div>
          <div class="col-lg-6 player-details" data-aos="fade-left">
            <div class="section-title">
              <h2>Player Profile</h2>
              <p class="fst-italic">player for GFJM Football Academy</p>
            </div>
            <div class="player-bio">
              <h3 class="mb-3"><?php echo $name; ?></h3>
              <ul class="player-stats list-unstyled">
                <li><strong>Age:</strong> <?php echo $age; ?> years old</li>
                <li><strong>Position:</strong> <?php echo $position; ?></li>
                <li><strong>Height:</strong> <?php echo $height; ?> cm</li>
                <li><strong>Weight:</strong> <?php echo $weight; ?> KG</li>
                <li><strong>Hometown:</strong> <?php echo $hometown; ?></li>
              </ul>
              <div class="player-quote mt-3">
                <blockquote class="blockquote">
                <header class="blockquote-footer">- player dream</header>
                  <p><?php echo $dream; ?></p>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Achievements Section -->
    <section id="features" class="features section">
    <div class="container">
      <div class="row gy-4">
        <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <img src="assets/img/pl.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-award flex-shrink-0"></i>
            <div>
              <h4>Title</h4>
              <p><?php echo $achievement_title; ?></p>
            </div>
          </div><!-- End Features Item-->
          
          <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-star flex-shrink-0"></i>
            <div>
              <h4>Best Player</h4>
              <p><?php echo $best_player; ?></p>
            </div>
          </div><!-- End Features Item-->
          
          <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-trophy flex-shrink-0"></i>
            <div>
              <h4>Achievement 3</h4>
              <p><?php echo $achievement_3; ?></p>
            </div>
          </div><!-- End Features Item-->
          
          <div class="features-item d-flex ps-0 ps-lg-3 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-flag flex-shrink-0"></i>
            <div>
              <h4>Achievement 4</h4>
              <p><?php echo $achievement_4; ?></p>
            </div>
          </div><!-- End Features Item-->
        </div>
      </div>
    </div>
  </section>

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <h2>medical</h2>
        <p>Check your medical status</p>
      </div><!-- End Section Title -->
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"></div>
              <a href="service-details.html" class="stretched-link"></a>
              <p><?php echo $medical_status; ?></p>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"></div>
              <a href="service-details.html" class="stretched-link"></a>
              <p><?php echo $medical_status; ?></p>
            </div>
          </div><!-- End Service Item -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"></div>
              <a href="service-details.html" class="stretched-link"></a>
              <p><?php echo $medical_status; ?></p>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
    </section><!-- /Services Section -->

    <!-- Team Section -->
    <section id="team" class="team section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>les entraineur</p>
      </div><!-- End Section Title -->
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img"></div>
              <div class="member-info">
                <p><?php echo $trainers; ?></p>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img"></div>
              <div class="member-info">
                <p><?php echo $trainers; ?></p>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img"></div>
              <div class="member-info">
                <p><?php echo $trainers; ?></p>
              </div>
            </div>
          </div><!-- End Team Member -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img"></div>
              <div class="member-info">
                <p><?php echo $trainers; ?></p>
              </div>
            </div>
          </div><!-- End Team Member -->
        </div>
      </div>
    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>emploi</h2>
        <p>emploi</p>
      </div><!-- End Section Title -->
      <section id="call-to-action" class="call-to-action section dark-background">
        <img src="assets/img/" alt="">
        <div class="container">
          <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
            <div class="col-xl-10">
              <div class="text-center"></div>
            </div>
          </div>
        </div>
      </section> 
      <div class="row gy-4">
        <div class="col-lg-4">
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div></div>
          </div><!-- End Info Item -->
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div></div>
          </div><!-- End Info Item -->
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div></div>
          </div><!-- End Info Item -->
        </div>
      </div>
    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">GP</span>
            </a>
            <div class="footer-contact pt-3">
              <p>MARRAKECH</p>
              <p>Morocco</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
              <p><strong>Email:</strong> <span>FRMF.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Design</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Development</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Product Management</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Marketing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Graphic Design</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">
      <div class="container text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">GP</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
          
          Designed by AYMAN ED-DAHHAK
        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
