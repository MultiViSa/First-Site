<?php

// Fehlerberichterstattung aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verbindungsdetails zur Datenbank
$servername = "localhost";
$username = "root"; // MariaDB-Benutzername
$password = "azubi"; // MariaDB-Passwort
$dbname = "register"; // Name der Datenbank

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging-Ausgaben hinzufügen
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Formular-Daten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Überprüfen, ob die POST-Daten vorhanden sind
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Passwort-Hashing (für eine sichere Passwortspeicherung)
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // SQL-Abfrage zur Benutzerüberprüfung
        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                echo "Login successful! Welcome " . htmlspecialchars($user);
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User does not exist.";
        }
    } else {
        echo "Username or password not set.";
    }
}

$conn->close();
?>
