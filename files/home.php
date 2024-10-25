<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestanden Beheer</title>
    <!-- Voeg hier de Tailwind CSS CDN link toe -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <?php  
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow' role='alert'>
                    <strong class='font-bold'>Succes!</strong>
                    <span class='block sm:inline'>" . htmlspecialchars($_SESSION['message']) . "</span>
                  </div>";
            unset($_SESSION['message']);
        }
        ?>

        <h2 class="text-2xl font-semibold mb-6">Upload een bestand</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-8 bg-white shadow-md rounded-lg p-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">Selecteer een bestand om te uploaden:</label>
            <input type="file" name="uploadedFile" required class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500 mb-4">
            <input type="submit" value="Upload Bestand" name="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
        </form>

        <h2 class="text-2xl font-semibold mb-4">Geüploade Bestanden</h2>
        <ul class="list-disc pl-5 space-y-4">
            <?php
            $uploadDirectory = 'uploads/';
            if (is_dir($uploadDirectory)) {
                $files = array_diff(scandir($uploadDirectory), array('.', '..'));
                foreach ($files as $file) {
                    echo "<li class='bg-white shadow-md rounded-lg p-4 flex items-center justify-between'>
                            <div class='flex items-center'>
                                <span class='text-blue-600 hover:underline'><a href='{$uploadDirectory}{$file}' target='_blank'>" . htmlspecialchars($file) . "</a></span> 
                                <a href='{$uploadDirectory}{$file}' download='" . htmlspecialchars($file) . "' class='text-gray-500 hover:text-gray-700 ml-4'>Download</a>
                            </div>
                            <div class='flex items-center'>
                                <form action='delete.php' method='post' class='inline ml-4' onsubmit=\"return confirm('Weet je zeker dat je dit bestand wilt verwijderen?');\">
                                    <input type='hidden' name='fileToDelete' value='" . htmlspecialchars($file) . "'>
                                    <input type='submit' value='Verwijder' class='bg-red-500 text-white font-bold py-1 px-2 rounded-md hover:bg-red-600 transition duration-200'>
                                </form>
                                <form action='send_email.php' method='post' class='inline ml-4'>
                                    <input type='hidden' name='fileToSend' value='" . htmlspecialchars($file) . "'>
                                    <input type='email' name='email' placeholder='E-mail' required class='border border-gray-300 rounded-md p-1 mr-2'>
                                    <input type='submit' value='Delen' class='bg-green-500 text-white font-bold py-1 px-2 rounded-md hover:bg-green-600 transition duration-200'>
                                </form>
                            </div>
                          </li>";
                }
            } else {
                echo "<p class='text-gray-500'>Er zijn nog geen bestanden geüpload.</p>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
