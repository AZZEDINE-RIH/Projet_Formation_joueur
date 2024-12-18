<?php
session_start(); // Gestion des sessions

// Connexion à la base de données
$host = 'localhost';
$dbname = 'joueur_inscription'; // Même base de données utilisée pour l'inscription
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Rechercher l'utilisateur par email
    $sql = "SELECT * FROM joueur WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Mot de passe correct, démarrer la session utilisateur
        $_SESSION['user'] = $user['firstname'];
        $message = "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['firstname']) . ".";
        header("Location: index.php"); // Redirection vers une page sécurisée
        exit;
    } else {
        // Si l'email ou le mot de passe est incorrect
        if (!$user) {
            $message = "L'email n'existe pas.";
        } else {
            $message = "Mot de passe incorrect.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
<section class="vh-100" style=" background: linear-gradient(to right, #008455, #bd2537);    ">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem; background-color: #07212e;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="assets/img/maroc.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

              <form method="POST" action="">
  <div class="d-flex align-items-center mb-3 pb-1">
    <span class="h1 fw-bold mb-0"><img src="assets/img/logo2.png" alt="logo"></span>
  </div>

  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color:#fff;">Sign into your account</h5>
  <?php if (isset($message)): ?>
    <p class="text-danger"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" required />
    <label class="form-label text-white" for="form2Example17">Email address</label>
  </div>

  <div data-mdb-input-init class="form-outline mb-4">
    <input type="password" id="form2Example27" name="password" class="form-control form-control-lg" required />
    <label class="form-label text-white" for="form2Example27">Password</label>
  </div>

  <div class="pt-1 mb-4">
    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
</div>
<div class="text-center">
<a href="index.php" class="boxed-btn" style="color: #fff;">Back to Home</a>
<a href="admin_Get-YOUR-FUTURE/login.php" class="boxed-btn" style="color: #fff;">admin login</a>

</div>

</form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>