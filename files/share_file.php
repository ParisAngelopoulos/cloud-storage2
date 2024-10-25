<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_POST['file_name'];
    $shared_with_email = $_POST['email'];

    // Get the user ID of the email to share the file with
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $shared_with_email]);
    $user = $stmt->fetch();

    if ($user) {
        $shared_with_id = $user['id'];

        // Insert the shared file into the database, including the email
        $stmt = $pdo->prepare("INSERT INTO shared_files (file_name, shared_with, shared_with_email) VALUES (:file_name, :shared_with, :shared_with_email)");
        $stmt->execute([
            'file_name' => $file_name, 
            'shared_with' => $shared_with_id, 
            'shared_with_email' => $shared_with_email // Add the email here
        ]);

        echo "Bestand succesvol gedeeld!";
    } else {
        echo "Gebruiker niet gevonden.";
    }
}

// Fetch files shared with the logged-in user (assuming user's email is stored in session)
$email = $_SESSION['email']; // Assuming user email is stored in session
$stmt = $pdo->prepare("SELECT f.file_name, f.shared_with_email FROM shared_files f JOIN users u ON f.shared_with = u.id WHERE u.email = :email");
$stmt->execute(['email' => $email]);
$shared_files = $stmt->fetchAll();
?>
