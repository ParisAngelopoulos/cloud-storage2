<?php
session_start();

$uploadDirectory = 'uploads/';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fileToDelete'])) {
    $fileToDelete = basename($_POST['fileToDelete']);
    $filePath = $uploadDirectory . $fileToDelete;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            $_SESSION['message'] = "Bestand succesvol verwijderd.";
        } else {
            $_SESSION['message'] = "Het verwijderen van het bestand is mislukt.";
        }
    } else {
        $_SESSION['message'] = "Bestand niet gevonden.";
    }
}

header('Location: home.php');
exit;
