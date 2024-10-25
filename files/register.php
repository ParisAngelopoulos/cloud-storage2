<?php
session_start();
require 'db.php'; // Zorg ervoor dat dit de databaseverbinding bevat

// Variabelen voor foutmeldingen en succesbericht
$usernameError = '';
$passwordError = '';
$confirmPasswordError = '';
$successMessage = '';

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Controleer gebruikersnaam
    if (empty($username)) {
        $usernameError = "Gebruikersnaam is verplicht.";
    } else {
        // Controleer of gebruikersnaam al bestaat
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $usernameError = "Deze gebruikersnaam is al in gebruik.";
        }
    }

    // Controleer wachtwoord
    if (empty($password)) {
        $passwordError = "Wachtwoord is verplicht.";
    } elseif (strlen($password) < 6) {
        $passwordError = "Wachtwoord moet minimaal 6 karakters zijn.";
    }

    // Controleer bevestigingswachtwoord
    if ($confirmPassword !== $password) {
        $confirmPasswordError = "Wachtwoorden komen niet overeen.";
    }

    // Voeg gebruiker toe als er geen fouten zijn
    if (empty($usernameError) && empty($passwordError) && empty($confirmPasswordError)) {
        // Wachtwoord hash voor veiligheid
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Voeg gebruiker toe aan database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            $successMessage = "Registratie succesvol! Je kunt nu inloggen.";
        } else {
            $usernameError = "Er is een probleem opgetreden. Probeer het opnieuw.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
    <div class="form-container">
        <h2>Registreren</h2>
        <?php if (!empty($successMessage)): ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" required>
                <?php if (!empty($usernameError)): ?>
                    <p class="error"><?php echo $usernameError; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" required>
                <?php if (!empty($passwordError)): ?>
                    <p class="error"><?php echo $passwordError; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Bevestig Wachtwoord:</label>
                <input type="password" name="confirm_password" required>
                <?php if (!empty($confirmPasswordError)): ?>
                    <p class="error"><?php echo $confirmPasswordError; ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="submit-btn">Registreren</button>
        </form>
        <p style="text-align: center;">Heb je al een account? <a href="login.php">Log in</a>.</p>
    </div>
</body>
</html>
