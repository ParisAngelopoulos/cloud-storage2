<?php
session_start();
include 'db.php'; // Zorg ervoor dat je de database verbinding hebt

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect naar inlogpagina als niet ingelogd
    exit();
}

// Feedback voor gebruikers
if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message']);
    unset($_SESSION['message']);
} else {
    $message = '';
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestanden Beheer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 w-full max-w-3xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Bestanden Beheer</h2>
            <a href="logout.php" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md hover:bg-red-600 transition duration-200">
                Uitloggen
            </a>
        </div>

        <?php if ($message): ?>
            <div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow mb-4' role='alert'>
                <strong class='font-bold'>Succes!</strong>
                <span class='block sm:inline'><?php echo $message; ?></span>
            </div>
        <?php endif; ?>

        <h2 class="text-2xl font-semibold mb-6 text-center">Upload een bestand</h2>
        <div class="mb-4 text-center">
            <a href="share.php" class="bg-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-green-600 transition duration-200">
                Bestanden Delen
            </a>
        </div>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-8 bg-white shadow-md rounded-lg p-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">Selecteer een bestand om te uploaden:</label>
            <input type="file" name="uploadedFile" required class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 mb-4">
            <input type="submit" value="Upload Bestand" name="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">
            <p class="text-sm text-gray-500 mt-2">Toegestane bestandstypen: JPG, PNG, GIF, PDF, DOCX.</p>
        </form>

        <h2 class="text-2xl font-semibold mb-4">Geüploade Bestanden</h2>
        <ul class="list-disc pl-5 space-y-4">
            <?php
            // Haal bestanden op die door de gebruiker zijn geüpload
            $userId = $_SESSION['user_id'];
            $stmt = $pdo->prepare("SELECT * FROM files WHERE uploaded_by = ?");
            $stmt->execute([$userId]);
            $files = $stmt->fetchAll();

            if (empty($files)) {
                echo "<p class='text-gray-500'>Er zijn nog geen bestanden geüpload.</p>";
            } else {
                foreach ($files as $file) {
                    echo "<li class='bg-white shadow-md rounded-lg p-4 flex items-center justify-between'>
                            <div class='flex items-center'>
                                <span class='text-blue-600 hover:underline'><a href='" . htmlspecialchars($file['file_path']) . "' target='_blank'>" . htmlspecialchars($file['file_name']) . "</a></span> 
                                <a href='" . htmlspecialchars($file['file_path']) . "' download='" . htmlspecialchars($file['file_name']) . "' class='text-gray-500 hover:text-gray-700 ml-4'>Download</a>
                            </div>
                            <div class='flex items-center'>
                                <form action='delete.php' method='post' class='inline ml-4' onsubmit=\"return confirm('Weet je zeker dat je dit bestand wilt verwijderen?');\">
                                    <input type='hidden' name='fileToDelete' value='" . htmlspecialchars($file['file_name']) . "'>
                                    <input type='submit' value='Verwijder' class='bg-red-500 text-white font-bold py-1 px-2 rounded-md hover:bg-red-600 transition duration-200'>
                                </form>
                            </div>
                          </li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
