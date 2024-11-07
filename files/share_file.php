<?php
session_start();
include 'db.php';

$message = ""; // For storing success or error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = trim($_POST['file_name']);
    $shared_with_email = trim($_POST['email']);

    // Check if both file_name and email are provided
    if ($file_name && $shared_with_email) {
        // Fetch user ID for the provided email
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $shared_with_email]);
        $user = $stmt->fetch();

        if ($user) {
            $shared_with_id = $user['id'];  // User ID to store in the shared_with column
            $shared_by_id = $_SESSION['user_id'];
            $shared_by_name = $_SESSION['username']; // Ensure this is set during login

            // Insert the shared file entry using the user ID for shared_with
            $stmt = $pdo->prepare("
                INSERT INTO shared_files (file_name, shared_with, shared_by, shared_by_name) 
                VALUES (:file_name, :shared_with, :shared_by, :shared_by_name)
            ");
            if ($stmt->execute([
                'file_name' => $file_name, 
                'shared_with' => $shared_with_id,  // Only the user ID, not email
                'shared_by' => $shared_by_id, 
                'shared_by_name' => $shared_by_name
            ])) {
                $message = "Bestand succesvol gedeeld met $shared_with_email!";
            } else {
                $message = "Er is een fout opgetreden bij het delen van het bestand.";
            }
        } else {
            $message = "Gebruiker niet gevonden met dit e-mailadres.";
        }
    } else {
        $message = "Zorg ervoor dat zowel het bestand als het e-mailadres zijn ingevuld.";
    }
}

// Fetch files shared with the logged-in user
$email = $_SESSION['email'];
$stmt = $pdo->prepare("
    SELECT f.file_name, f.shared_by_name 
    FROM shared_files f 
    JOIN users u ON f.shared_with = u.id 
    WHERE u.email = :email
");
$stmt->execute(['email' => $email]);
$shared_files = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestanden Delen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Deel een Bestand</h1>
        
        <!-- Toon berichten als die er zijn -->
        <?php if ($message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4" role="alert">
                <strong><?php echo htmlspecialchars($message); ?></strong>
            </div>
        <?php endif; ?>

        <form action="share_file.php" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="mb-4">
                <label for="file_name" class="block text-sm font-medium text-gray-700">Kies een bestand om te delen:</label>
                <select id="file_name" name="file_name" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Selecteer een bestand --</option>
                    <?php
                    // Hier zou je ook de bestanden van de ingelogde gebruiker moeten ophalen
                    $userId = $_SESSION['user_id'];
                    $stmt = $pdo->prepare("SELECT * FROM files WHERE uploaded_by = ?");
                    $stmt->execute([$userId]);
                    $user_files = $stmt->fetchAll();

                    foreach ($user_files as $file): ?>
                        <option value="<?php echo htmlspecialchars($file['file_name']); ?>"><?php echo htmlspecialchars($file['file_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Deel met E-mailadres:</label>
                <input type="email" id="email" name="email" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">Deel Bestand</button>
        </form>

        <h2 class="text-2xl font-semibold mb-4">Bestanden Gedeeld met Jou</h2>
        <ul class="list-disc pl-5 space-y-2">
            <?php if (!empty($shared_files)): ?>
                <?php foreach ($shared_files as $file): ?>
                    <li class='bg-white shadow-md rounded-lg p-4'><?php echo htmlspecialchars($file['file_name']); ?> (Gedeeld door: <?php echo htmlspecialchars($file['shared_by_name']); ?>)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class='text-gray-500'>Er zijn geen bestanden met jou gedeeld.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
