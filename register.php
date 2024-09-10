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

echo "Database connection successful.<br>";

// Formular-Daten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Register button clicked.<br>";

    // Überprüfen, ob die POST-Daten vorhanden sind
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];

        // Überprüfen, ob Benutzername bereits existiert
        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Username already exists.";
        } else {
            // Passwort-Hashing (für eine sichere Passwortspeicherung)
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Benutzer in der Datenbank speichern
            $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                echo "Registration successful! You can now log in.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Username, email, or password not set.";
    }
}

$conn->close();
?>
