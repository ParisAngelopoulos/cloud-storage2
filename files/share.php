<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Sharing</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Deel een Bestand</h1>
        
        <form action="share_file.php" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="mb-4">
                <label for="file_name" class="block text-sm font-medium text-gray-700">Bestandsnaam:</label>
                <input type="text" id="file_name" name="file_name" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Deel met E-mailadres:</label>
                <input type="email" id="email" name="email" required class="block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition duration-200">Deel Bestand</button>
        </form>

        <h2 class="text-2xl font-semibold mb-4">Bestanden Gedeeld met Jou</h2>
        <ul class="list-disc pl-5 space-y-2">
            <?php
            // Display files shared with the user
            if (!empty($shared_files)) {
                foreach ($shared_files as $file) {
                    echo "<li class='bg-white shadow-md rounded-lg p-4'>" . htmlspecialchars($file['file_name']) . "</li>";
                }
            } else {
                echo "<li class='text-gray-500'>Er zijn geen bestanden met jou gedeeld.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
