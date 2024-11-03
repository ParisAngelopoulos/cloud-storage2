<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Redirect naar home.php als de gebruiker al is ingelogd
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Inloggen</h2>
        
        <!-- Toon foutmelding als er een error is doorgegeven -->
        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <strong class="font-bold">Fout!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($_GET['error']); ?></span>
            </div>
        <?php endif; ?>

        <form action="login_process.php" method="post" class="space-y-4">
            <div class="form-group">
                <label for="username" class="block text-sm font-medium text-gray-700">Gebruikersnaam:</label>
                <input type="text" name="username" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord:</label>
                <input type="password" name="password" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">Inloggen</button>
        </form>
        
        <p class="mt-4 text-center">Nog geen account? <a href="register.php" class="text-blue-600 hover:underline">Registreren</a></p>
    </div>
</body>
</html>
