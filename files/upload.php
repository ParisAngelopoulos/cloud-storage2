<?php
// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of er een bestand is geüpload zonder fouten
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        // Bestand en pad informatie
        $bestandsNaam = basename($_FILES['uploadedFile']['name']);
        $uploadMap = 'uploads/'; // Zorg ervoor dat deze map schrijfbaar is
        $doelBestand = $uploadMap . $bestandsNaam;

        // Controleer of de uploads map bestaat, en maak deze indien nodig aan
        if (!is_dir($uploadMap)) {
            mkdir($uploadMap, 0777, true); // Maak de map aan met schrijfrechten
        }

        // Controleer het bestandstype om veiligheid te waarborgen
        $bestandType = strtolower(pathinfo($doelBestand, PATHINFO_EXTENSION));
        $toegestaneTypes = array('jpg', 'png', 'gif', 'pdf', 'docx'); // Voeg bestandstypen toe die je toestaat

        if (in_array($bestandType, $toegestaneTypes)) {
            // Verplaats het bestand naar de uploadmap
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
