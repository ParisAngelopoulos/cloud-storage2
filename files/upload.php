<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $bestandsNaam = basename($_FILES['uploadedFile']['name']);
        $uploadMap = 'uploads/'; 
        $doelBestand = $uploadMap . $bestandsNaam;

        if (!is_dir($uploadMap)) {
            mkdir($uploadMap, 0777, true); /
        }

        $bestandType = strtolower(pathinfo($doelBestand, PATHINFO_EXTENSION));
        $toegestaneTypes = array('jpg', 'png', 'gif', 'pdf', 'docx');

        if (in_array($bestandType, $toegestaneTypes)) {
            if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $doelBestand)) {
                header("Location: home.php");
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
