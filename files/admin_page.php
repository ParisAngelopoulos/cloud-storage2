<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect naar inloggen als niet geautoriseerd
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina</title>
</head>
<body>
    <h1>Welkom Admin!</h1>
    <p>Je hebt toegang tot de admin functionaliteiten.</p>
    <a href="logout.php">Uitloggen</a>
</body>
</html>
