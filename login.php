<?php
include('connexion.php');
session_start();

// Initialize error variable
$error = '';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Handle 'Remember Me' cookies
if (isset($_COOKIE['user_id']) && isset($_COOKIE['email']) && !isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['email'] = $_COOKIE['email'];
    header('Location: index.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
<<<<<<< HEAD
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
    $rememberMe = isset($_POST['remember']);

    try {
        // Fetch user details
        $stmt = $pdo->prepare("SELECT id, nom, email, password FROM admins WHERE email = ?");
=======
    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];
    $rememberMe = isset($_POST['rememberMe']);

    try {
        // Fetch user details
        $stmt = $pdo->prepare("SELECT id,nom, email, password FROM admins WHERE email = ?");
>>>>>>> fb1d3916757e51253a73e398aeefcbc495b4175a
        $stmt->execute([$inputEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($inputPassword, $user['password'])) {
            // Store session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
<<<<<<< HEAD
            $_SESSION['nom'] = $user['nom'];
=======
            $_SESSION['nom']=$user['nom'];
>>>>>>> fb1d3916757e51253a73e398aeefcbc495b4175a

            // Handle 'Remember Me' functionality
            if ($rememberMe) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), '/'); // 30 days
                setcookie('email', $user['email'], time() + (86400 * 30), '/'); // 30 days
            }

            // Redirect to index.php
            header('Location: index.php');
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } catch (PDOException $e) {
        $error = 'Error: ' . htmlspecialchars($e->getMessage());
    }
}
?>
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div>
                                <?php if ($error): ?>
                                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                                <?php endif; ?>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login">Sign In</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have an account?
                                    <a href="#">Sign Up Here</a>
                                </p>
=======

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">
                                    <!-- Display error message -->
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo htmlspecialchars($error); ?>
                                        </div>
                                    <?php endif; ?>
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="rememberMe" name="rememberMe" type="checkbox" />
                                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="forgot_password.php">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit" name="login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
>>>>>>> fb1d3916757e51253a73e398aeefcbc495b4175a
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
</body>

=======
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
>>>>>>> fb1d3916757e51253a73e398aeefcbc495b4175a
</html>
