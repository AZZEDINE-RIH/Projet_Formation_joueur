<?php

require_once 'conn.php';

session_start();

$error_message = ''; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation des champs
    if (!empty($email) && !empty($password)) {
        try {
            // Connexion à la base de données
            $db = Database::getInstance();
            $pdo = $db->getConnection();

            
            $sql = "SELECT * FROM members WHERE email = :email";
            $stmt = $pdo->prepare($sql);

           
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Exécuter la requête
            $stmt->execute();

            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification si l'utilisateur existe
            if ($stmt->rowCount() == 1 && $user) {
               
                if ($password === $user['password']) {
                    // Stocker les informations de session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];

                    
                    if (isset($_POST["connecter"])) {
                        $expire = time() + 2 * 30 * 24 * 3600; // 2 mois
                        setcookie("autoriser", $user['id'], $expire);
                    }

                    
                    header("Location: entraineur.php");
                    exit();
                } else {
                    $error_message = "Email ou mot de passe invalide.";
                }
            } else {
                $error_message = "Email ou mot de passe invalide.";
            }
        } catch (Exception $e) {
            $error_message = "Erreur interne : " . $e->getMessage();
        }
    } else {
        $error_message = "Veuillez entrer l'email et le mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Page de connexion</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <form method="POST" action="" class="bg-white rounded shadow-5-strong p-5">
                <h1 class="text-center">Login</h1>
                
                <!-- Affichage du message d'erreur -->
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <!-- Email -->
                <div class="form-outline mb-4">
                    <input type="email" name="email" id="email" class="form-control" required />
                    <label class="form-label" for="email">Adresse email</label>
                </div>

                <!-- Mot de passe -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="pass" class="form-control" required />
                    <label class="form-label" for="pass">Mot de passe</label>
                </div>

                <!-- Option rester connecté -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="check" id="check" name="connecter" />
                            <label class="form-check-label" for="check">Rester connecter</label>
                        </div>
                    </div>
                    <div class="col text-center">
                        <a href="#!">Mot de passe oublié ?</a>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
