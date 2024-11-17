<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
if (session_destroy()) {
    // Optional: Clear any cookies related to the session or user
    if (isset($_COOKIE['user_id']) || isset($_COOKIE['email'])) {
        setcookie('user_id', '', time() - 3600, '/'); // Expire the cookie
        setcookie('email', '', time() - 3600, '/');   // Expire the cookie
    }

    // Redirect to the login page with a success message
    header('Location: login.php?message=logout_success');
    exit();
} else {
    echo 'Error: Unable to log out.';
}
?>
