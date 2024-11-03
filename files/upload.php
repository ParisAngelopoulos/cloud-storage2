<?php
session_start();
include 'db.php'; 

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect naar inlogpagina als niet ingelogd
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $bestandsNaam = basename($_FILES['uploadedFile']['name']);
        $uploadMap = 'uploads/'; 
        $doelBestand = $uploadMap . $bestandsNaam;

        // Maak de uploads directory aan als deze niet bestaat
        if (!is_dir($uploadMap)) {
            mkdir($uploadMap, 0777, true); 
        }

        $bestandType = strtolower(pathinfo($doelBestand, PATHINFO_EXTENSION));
        $toegestaneTypes = array('jpg', 'png', 'gif', 'pdf', 'docx');

        if (in_array($bestandType, $toegestaneTypes)) {
            if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $doelBestand)) {
                // Opslaan van file-informatie in de database
                $userId = $_SESSION['user_id']; // Verkrijg het ID van de ingelogde gebruiker
                $stmt = $pdo->prepare("INSERT INTO files (file_name, file_path, uploaded_by) VALUES (?, ?, ?)");
                if ($stmt->execute([$bestandsNaam, $doelBestand, $userId])) {
                    $_SESSION['message'] = "Bestand succesvol geüpload.";
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Er was een probleem bij het opslaan van de bestandsinformatie in de database.";
                }
            } else {
                echo "Er was een probleem bij het uploaden van het bestand.";
            }
        } else {
            echo "Ongeldig bestandstype. Alleen JPG, PNG, GIF, PDF en DOCX zijn toegestaan.";
        }
    } else {
        echo "Er was een fout bij het uploaden van het bestand.";
    }
} else {
    echo "Geen bestand ontvangen.";
}
?>
