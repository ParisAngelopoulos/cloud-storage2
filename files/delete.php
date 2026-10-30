<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fileId'])) {
    // Alleen je eigen bestanden kun je verwijderen
    $stmt = $pdo->prepare("SELECT * FROM files WHERE id = ? AND uploaded_by = ?");
    $stmt->execute([$_POST['fileId'], $_SESSION['user_id']]);
    $file = $stmt->fetch();

    if ($file) {
        if (file_exists($file['file_path'])) {
            unlink($file['file_path']);
        }
        // Ook uit de database halen, anders blijft het in de lijst staan
        $pdo->prepare("DELETE FROM shared_files WHERE file_name = ? AND shared_by = ?")->execute([$file['file_name'], $_SESSION['user_id']]);
        $pdo->prepare("DELETE FROM files WHERE id = ?")->execute([$file['id']]);
        $_SESSION['message'] = "Bestand succesvol verwijderd.";
    } else {
        $_SESSION['message'] = "Bestand niet gevonden.";
    }
}

header('Location: home.php');
exit;
