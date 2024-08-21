<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. Verbindungsdetails zur Datenbank
$servername = "192.168.123.20"; // oder die IP des Servers
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
    $username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : null;
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : null;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
}

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

echo '<pre>';
print_r($_POST);
echo '</pre>';

// 6. Verbindung schließen
$conn->close();
?>
