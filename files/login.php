<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <form action="login_process.php" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Inloggen">
    </form>
    
    <p>Nog geen account? <a href="register.php">Registreren</a></p>
</body>
</html>
