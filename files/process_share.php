<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileToShare = $_POST['fileToShare'];
    $userId = $_POST['userId'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $email = $user['email'];

        $subject = "Bestand Delen: " . htmlspecialchars($fileToShare);
        $message = "Beste gebruiker,\n\nEen bestand is met jou gedeeld: " . htmlspecialchars($fileToShare) . "\n\nJe kunt het bestand downloaden via de volgende link:\n" . 
                   "http://jouwwebsite.com/uploads/" . urlencode($fileToShare) . "\n\nMet vriendelijke groet,\nJe website naam";
        $headers = "From: noreply@jouwwebsite.com\r\n" . 
                   "Reply-To: noreply@jouwwebsite.com\r\n" . 
                   "X-Mailer: PHP/" . phpversion();

        if (mail($email, $subject, $message, $headers)) {
            echo "Bestand succesvol gedeeld met " . htmlspecialchars($email) . ".";
        } else {
            echo "Er was een probleem bij het verzenden van de e-mail.";
        }
    } else {
        echo "Ongeldige gebruiker.";
    }
} else {
    echo "Geen gegevens ontvangen.";
}
?>
