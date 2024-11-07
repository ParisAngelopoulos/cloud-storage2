<?php
session_start();
include 'db.php'; // Ensure the database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch files shared with the logged-in user
$stmt = $pdo->prepare("SELECT * FROM shared_files WHERE shared_with = ?");
$stmt->execute([$userId]); // Use user ID here instead of username
$shared_files = $stmt->fetchAll();

// Fetch files uploaded by the logged-in user
$stmt = $pdo->prepare("SELECT * FROM files WHERE uploaded_by = ?");
$stmt->execute([$userId]);
$uploaded_files = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_name = trim($_POST['file_name']); // Comes from the dropdown
    $email = trim($_POST['email']);

    // Fetch the user ID associated with the provided email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $shared_with_id = $user['id']; // ID of the user the file is shared with
        $shared_by_id = $_SESSION['user_id']; // ID of the current (logged-in) user
        $shared_by_name = $_SESSION['username']; // Name of the current user
    
        // Insert the shared file with shared_by_name included
        $stmt = $pdo->prepare("INSERT INTO shared_files (file_name, shared_by, shared_with, shared_by_name, shared_with_email) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$file_name, $shared_by_id, $shared_with_id, $shared_by_name, $email])) {
            $_SESSION['message'] = "Bestand succesvol gedeeld met $email.";
        } else {
            $_SESSION['message'] = "Er is een probleem opgetreden tijdens het delen van het bestand.";
        }
    }
    
    
    header("Location: share.php");
    exit();
}
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
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <form action="share.php" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="mb-4">
                <label for="file_name" class="block text-sm font-medium text-gray-700">Kies een bestand om te delen:</label>
                <select id="file_name" name="file_name" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Selecteer een bestand --</option>
                    <?php foreach ($uploaded_files as $file): ?>
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
                    <li class='bg-white shadow-md rounded-lg p-4'><?php echo htmlspecialchars($file['file_name']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class='text-gray-500'>Er zijn geen bestanden met jou gedeeld.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
