<?php
session_start();
require 'db.php'; // Zorg ervoor dat de databaseverbinding goed is

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zoek de gebruiker in de database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Controleer of de gebruiker bestaat en het wachtwoord klopt
    if ($user && password_verify($password, $user['password'])) {
        // Sla gebruikersinformatie op in de sessie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect op basis van rol
        if ($user['role'] === 'admin') {
            header('Location: admin_page.php'); // Admin pagina
            exit;
        } else {
            header('Location: home.php'); // Gebruikerspagina
            exit;
        }
    } else {
        echo "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
