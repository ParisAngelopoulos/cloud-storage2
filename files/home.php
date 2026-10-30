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
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen">
    <?php include 'header.php'; include 'file_helpers.php'; ?>
    <main class="max-w-5xl mx-auto px-4 py-8">
        <?php if ($message): ?>
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3" role="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php
        // Files uploaded by the logged-in user
        $stmt = $pdo->prepare("SELECT * FROM files WHERE uploaded_by = ? ORDER BY upload_date DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $files = $stmt->fetchAll();
        ?>

        <div class="grid gap-6 md:grid-cols-3">
            <section class="md:col-span-1">
                <form action="upload.php" method="post" enctype="multipart/form-data" class="bg-white rounded-xl border border-slate-200 p-5">
                    <h2 class="font-semibold text-gray-900 mb-3">Bestand uploaden</h2>
                    <label class="block cursor-pointer rounded-lg border-2 border-dashed border-slate-300 p-6 text-center hover:border-brand hover:bg-sky-50 transition">
                        <span class="block text-3xl">⬆️</span>
                        <span id="gekozen" class="block mt-2 text-sm text-gray-600">Kies een bestand</span>
                        <input type="file" name="uploadedFile" required class="hidden" onchange="document.getElementById('gekozen').textContent = this.files[0] ? this.files[0].name : 'Kies een bestand'">
                    </label>
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG, GIF, PDF of DOCX</p>
                    <input type="submit" value="Uploaden" name="submit" class="mt-4 w-full bg-brand text-white font-semibold py-2 rounded-lg cursor-pointer hover:bg-brand-dark">
                </form>
                <a href="share.php" class="mt-4 block text-center bg-white rounded-xl border border-slate-200 p-4 text-brand font-semibold hover:bg-sky-50">Bestanden delen of bekijken wat met jou gedeeld is →</a>
            </section>

            <section class="md:col-span-2">
                <h1 class="text-xl font-bold text-gray-900 mb-3">Mijn bestanden <span class="text-gray-400 font-normal">(<?php echo count($files); ?>)</span></h1>
                <?php if (empty($files)): ?>
                    <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-gray-500">Je hebt nog geen bestanden. Upload er links een.</div>
                <?php endif; ?>
                <ul class="space-y-3">
                    <?php foreach ($files as $file): [$icon, $bg] = file_icon($file['file_name']); ?>
                        <li class="bg-white rounded-xl border border-slate-200 p-4 flex items-center gap-4">
                            <span class="w-11 h-11 rounded-lg <?php echo $bg; ?> flex items-center justify-center text-xl"><?php echo $icon; ?></span>
                            <div class="flex-1 min-w-0">
                                <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank" class="font-medium text-gray-900 hover:text-brand truncate block"><?php echo htmlspecialchars($file['file_name']); ?></a>
                                <div class="text-xs text-gray-500"><?php echo htmlspecialchars(trim(file_size($file['file_path']) . ' · ' . date('d-m-Y', strtotime($file['upload_date'])), ' ·')); ?></div>
                            </div>
                            <a href="<?php echo htmlspecialchars($file['file_path']); ?>" download="<?php echo htmlspecialchars($file['file_name']); ?>" class="text-sm text-brand font-semibold hover:underline">Download</a>
                            <form action="delete.php" method="post" onsubmit="return confirm('Weet je zeker dat je dit bestand wilt verwijderen?');">
                                <input type="hidden" name="fileId" value="<?php echo (int)$file['id']; ?>">
                                <input type="submit" value="Verwijder" class="text-sm text-red-600 hover:underline cursor-pointer bg-transparent">
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </main>
</body>
</html>
