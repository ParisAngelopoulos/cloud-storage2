<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); 
    exit;
}

// Databaseverbinding (verander de gegevens hier naar jouw situatie)
include 'db.php';

// Numbers for the overview
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalFiles = $pdo->query("SELECT COUNT(*) FROM files")->fetchColumn();
$totalShares = $pdo->query("SELECT COUNT(*) FROM shared_files")->fetchColumn();
// Files per user, for the bar chart
$perUser = $pdo->query("SELECT users.username, users.role, COUNT(files.id) AS files
                        FROM users LEFT JOIN files ON files.uploaded_by = users.id
                        GROUP BY users.id ORDER BY files DESC, users.username")->fetchAll();
$max = max(1, ...array_map(fn ($u) => (int)$u['files'], $perUser));
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht · Cloud Storage</title>
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen">
    <?php include 'header.php'; ?>
    <main class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-900">Welkom, admin</h1>
        <p class="text-gray-600 mb-6">Een overzicht van wat er in Cloud Storage gebeurt.</p>

        <div class="grid gap-4 sm:grid-cols-3 mb-8">
            <?php foreach ([['Gebruikers', $totalUsers, '👤'], ['Bestanden', $totalFiles, '📁'], ['Keer gedeeld', $totalShares, '🔗']] as [$label, $count, $icon]): ?>
                <div class="bg-white rounded-xl border border-slate-200 p-5">
                    <div class="text-2xl"><?php echo $icon; ?></div>
                    <div class="mt-2 text-3xl font-bold text-gray-900"><?php echo (int)$count; ?></div>
                    <div class="text-sm text-gray-500"><?php echo $label; ?></div>
                </div>
            <?php endforeach; ?>
        </div>

        <section class="bg-white rounded-xl border border-slate-200 p-6">
            <h2 class="font-semibold text-gray-900 mb-4">Bestanden per gebruiker</h2>
            <div class="space-y-3">
                <?php foreach ($perUser as $user): ?>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-24 truncate"><?php echo htmlspecialchars($user['username']); ?><?php if ($user['role'] === 'admin') echo ' <span class="text-xs text-gray-400">(admin)</span>'; ?></span>
                        <div class="flex-1 h-6 bg-slate-100 rounded">
                            <div class="h-6 bg-brand rounded" style="width: <?php echo round($user['files'] / $max * 100); ?>%"></div>
                        </div>
                        <span class="w-6 text-right font-semibold"><?php echo (int)$user['files']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
