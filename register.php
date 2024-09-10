<?php
// Fehlerberichterstattung aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verbindungsdetails zur Datenbank
$servername = "localhost";
$username = "root"; // MariaDB-Benutzername
$password = "azubi";     // MariaDB-Passwort
$dbname = "loginsystem";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Formular-Daten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registrieren-Formular wurde gesendet
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];

        // Überprüfen, ob Benutzername bereits existiert
        $sql = "SELECT * FROM users WHERE username='$user' OR email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Username or email already exists.";
        } else {
            // Passwort-Hashing (für sichere Passwortspeicherung)
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Benutzer in der Datenbank speichern
            $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$hashed_password', '$email')";
            if ($conn->query($sql) === TRUE) {
                echo "Registration successful! You can now log in.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>