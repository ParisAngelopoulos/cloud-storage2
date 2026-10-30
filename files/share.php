<?php
session_start();
include 'db.php'; // Ensure the database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch files shared with the logged-in user, with the path so they can be opened
$stmt = $pdo->prepare("SELECT shared_files.file_name, shared_files.shared_by_name, files.file_path
                       FROM shared_files
                       LEFT JOIN files ON files.file_name = shared_files.file_name AND files.uploaded_by = shared_files.shared_by
                       WHERE shared_files.shared_with = ?");
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

    // You can only share your own files
    $own_files = array_column($uploaded_files, 'file_name');

    if (!in_array($file_name, $own_files, true)) {
        $_SESSION['message'] = "Je kunt alleen je eigen bestanden delen.";
    } elseif (!$user) {
        $_SESSION['message'] = "Er is geen gebruiker met het e-mailadres $email.";
    } elseif ($user['id'] == $_SESSION['user_id']) {
        $_SESSION['message'] = "Je kunt een bestand niet met jezelf delen.";
    } else {
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
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body class="bg-slate-50 text-gray-800 min-h-screen">
    <?php include 'header.php'; include 'file_helpers.php'; ?>
    <main class="max-w-5xl mx-auto px-4 py-8">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="mb-6 rounded-lg bg-sky-50 border border-sky-200 text-sky-900 px-4 py-3">
                <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="grid gap-6 md:grid-cols-2">
            <section>
                <h1 class="text-xl font-bold text-gray-900 mb-3">Een bestand delen</h1>
                <form action="share.php" method="POST" class="bg-white rounded-xl border border-slate-200 p-5 space-y-4">
                    <label class="block">
                        <span class="text-sm font-medium text-gray-700">Welk bestand?</span>
                        <select id="file_name" name="file_name" required class="mt-1 block w-full border border-slate-300 rounded-lg p-2 bg-white">
                            <option value="">-- Kies een van je bestanden --</option>
                            <?php foreach ($uploaded_files as $file): ?>
                                <option value="<?php echo htmlspecialchars($file['file_name']); ?>"><?php echo htmlspecialchars($file['file_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium text-gray-700">Met wie? (e-mailadres)</span>
                        <input type="email" id="email" name="email" required placeholder="bijvoorbeeld daan@voorbeeld.nl" class="mt-1 block w-full border border-slate-300 rounded-lg p-2">
                    </label>
                    <button type="submit" class="w-full bg-brand text-white font-semibold py-2 rounded-lg hover:bg-brand-dark">Delen</button>
                </form>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3">Gedeeld met jou <span class="text-gray-400 font-normal">(<?php echo count($shared_files); ?>)</span></h2>
                <?php if (empty($shared_files)): ?>
                    <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-gray-500">Er zijn nog geen bestanden met jou gedeeld.</div>
                <?php endif; ?>
                <ul class="space-y-3">
                    <?php foreach ($shared_files as $file): [$icon, $bg] = file_icon($file['file_name']); ?>
                        <li class="bg-white rounded-xl border border-slate-200 p-4 flex items-center gap-4">
                            <span class="w-11 h-11 rounded-lg <?php echo $bg; ?> flex items-center justify-center text-xl"><?php echo $icon; ?></span>
                            <div class="flex-1 min-w-0">
                                <?php if ($file['file_path']): ?>
                                    <a href="<?php echo htmlspecialchars($file['file_path']); ?>" target="_blank" class="font-medium text-gray-900 hover:text-brand truncate block"><?php echo htmlspecialchars($file['file_name']); ?></a>
                                <?php else: ?>
                                    <span class="font-medium text-gray-500 truncate block"><?php echo htmlspecialchars($file['file_name']); ?> (verwijderd)</span>
                                <?php endif; ?>
                                <div class="text-xs text-gray-500">van <?php echo htmlspecialchars($file['shared_by_name']); ?></div>
                            </div>
                            <?php if ($file['file_path']): ?>
                                <a href="<?php echo htmlspecialchars($file['file_path']); ?>" download class="text-sm text-brand font-semibold hover:underline">Download</a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </main>
</body>
</html>
