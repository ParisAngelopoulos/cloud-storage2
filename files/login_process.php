<?php
session_start();
require 'db.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valideer de gebruikersinvoer
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        $errorMessage = "Vul alstublieft zowel gebruikersnaam als wachtwoord in.";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Bereid de SQL-query voor
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Controleer of de gebruiker bestaat en verifieer het wachtwoord
        if ($user && password_verify($password, $user['password'])) {
            // Sla gebruikersgegevens op in de sessie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect op basis van rol
            if ($user['role'] === 'admin') {
                header('Location: admin_page.php'); 
            } else {
                header('Location: home.php'); 
            }
            exit; // Zorg ervoor dat je het script hier beëindigt
        } else {
            $errorMessage = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }

    // Opslaan van foutmeldingen in de sessie (voor flash messages)
    if ($errorMessage) {
        $_SESSION['error'] = $errorMessage;
        header('Location: index.php?error=' . urlencode($errorMessage));
        exit;
    }
}
