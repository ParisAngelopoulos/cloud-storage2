<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); 
    exit;
}

// Databaseverbinding (verander de gegevens hier naar jouw situatie)
include 'db.php';

// Aantal gebruikers opvragen
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$totalUsers = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Voeg Chart.js toe -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <!-- Voeg Tailwind CSS toe -->
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Welkom Admin!</h1>
        <p class="mb-4">Je hebt toegang tot de admin functionaliteiten.</p>
        <a href="logout.php" class="text-blue-600 hover:underline">Uitloggen</a>

        <!-- Grafiek sectie -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4">Aantal Gebruikers</h2>
            <canvas id="userChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script>
        // Configuratie van de grafiek
        const ctx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'bar', // of 'line', 'pie', etc.
            data: {
                labels: ['Totaal Aantal Gebruikers'], // Label voor de grafiek
                datasets: [{
                    label: 'Aantal gebruikers',
                    data: [<?php echo $totalUsers; ?>], // Aantal gebruikers uit PHP
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // Kleur van de balk
                    borderColor: 'rgba(54, 162, 235, 1)', // Randkleur
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
