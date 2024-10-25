<?php
session_start();
require 'db.php'; 

$usernameError = '';
$passwordError = '';
$confirmPasswordError = '';
$emailError = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $email = trim($_POST['email']);

    if (empty($username)) {
        $usernameError = "Gebruikersnaam is verplicht.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $usernameError = "Deze gebruikersnaam is al in gebruik.";
        }
    }

    if (empty($email)) {
        $emailError = "E-mail is verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Voer een geldig e-mailadres in.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $emailError = "Dit e-mailadres is al in gebruik.";
        }
    }

    if (empty($password)) {
        $passwordError = "Wachtwoord is verplicht.";
    } elseif (strlen($password) < 6) {
        $passwordError = "Wachtwoord moet minimaal 6 karakters zijn.";
    }

    if ($confirmPassword !== $password) {
        $confirmPasswordError = "Wachtwoorden komen niet overeen.";
    }

    if (empty($usernameError) && empty($passwordError) && empty($confirmPasswordError) && empty($emailError)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'user')");
        if ($stmt->execute([$username, $hashedPassword, $email])) {
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Registreren</h2>
        <?php if (!empty($successMessage)): ?>
            <p class="text-green-600 text-center"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post" class="space-y-4">
            <div class="form-group">
                <label for="username" class="block text-sm font-medium text-gray-700">Gebruikersnaam:</label>
                <input type="text" name="username" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                <?php if (!empty($usernameError)): ?>
                    <p class="text-red-500 text-sm"><?php echo $usernameError; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
                <input type="email" name="email" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                <?php if (!empty($emailError)): ?>
                    <p class="text-red-500 text-sm"><?php echo $emailError; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord:</label>
                <input type="password" name="password" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                <?php if (!empty($passwordError)): ?>
                    <p class="text-red-500 text-sm"><?php echo $passwordError; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Bevestig Wachtwoord:</label>
                <input type="password" name="confirm_password" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                <?php if (!empty($confirmPasswordError)): ?>
                    <p class="text-red-500 text-sm"><?php echo $confirmPasswordError; ?></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">Registreren</button>
        </form>
        <p class="text-center mt-4">Heb je al een account? <a href="index.php" class="text-blue-600 hover:underline">Log in</a>.</p>
    </div>
</body>
</html>
