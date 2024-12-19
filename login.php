<?php
session_start(); // Gestion des sessions

require_once 'conn.php';

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier que les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        // Rechercher l'utilisateur dans la base de données
        $sql = "SELECT * FROM entraineur WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password === $user['password'] ) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Gérer l'option "Rester connecté"
         
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}

// Vérifier si l'utilisateur est  connecté avec un cookie
// if (isset($_COOKIE['user_id'])) {
//     $_SESSION['user_id'] = $_COOKIE['user_id'];
//     header('Location: index.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Single News</title>

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

    <style>
		.main-menu ul li.active a {
			color:  #2596c5; /* Orange color to match the theme */
			font-weight: bold;
		}
	</style>

</head>
<body>
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
                                <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

								<li class="<?php echo ($current_page == 'index.php') ?>"><a href="index.php">Home</a></li>
                                
								<li class="<?php echo ($current_page == 'about.php')  ?>"><a href="about.php">About</a></li>
								
								<li class="<?php echo ($current_page == 'contact.php') ?>"><a href="contact.php">Contact</a></li>
								
								<li>
									<div class="header-icons">
										
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
    
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>GET YOUR FUTURE</p>
						<h1>Hello coach </h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	
	<!-- single article section -->
	<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <br><br>
  <div class="form-container">
        <h2 class="text-center mb-4">Login</h2>

        <!-- Afficher un message d'erreur ou de succès -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Mot de Passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se Connecter</button>
           
        </form>
    </div>
  
  

	<!-- end single article section -->

	<br><br><br><br>

	<!-- footer -->
	<footer>

	</footer>

	


</body>
</html>