<?php
// 1. Verbindungsdetails zur Datenbank
$servername = "192.168-123.20"; // oder die IP des Servers
$username = "azubi"; // Datenbank-Benutzername
$password = "azubi"; // Datenbank-Passwort
$dbname = "Test"; // Name der Datenbank

// 2. Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// 3. Daten aus dem Formular verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = $conn->real_escape_string($_POST['benutzername']);
    $email = $conn->real_escape_string($_POST['email']);
    $passwort = password_hash($_POST['passwort'], PASSWORD_DEFAULT); // Passwort sicher hashen

    // 4. Überprüfen, ob der Benutzername oder die E-Mail bereits existieren
    $sql = "SELECT id FROM users WHERE benutzername='$benutzername' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Benutzername oder E-Mail bereits vergeben.";
    } else {
        // 5. Benutzer in der Datenbank speichern
        $sql = "INSERT INTO users (benutzername, email, passwort) VALUES ('$benutzername', '$email', '$passwort')";

        if ($conn->query($sql) === TRUE) {
            echo "Registrierung erfolgreich!";
        } else {
            echo "Fehler: " . $sql . "<br>" . $conn->error;
        }
    }
}

// 6. Verbindung schließen
$conn->close();
?>
