<?php
// Fehlerberichterstattung aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "azubi";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Database connection successful.<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        echo "Register button clicked.<br>";

        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Überprüfen, ob Benutzername bereits existiert
        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Username already exists.";
        } else {
            // Passwort-Hashing (für sichere Passwortspeicherung)
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Benutzer in der Datenbank speichern
            $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                echo "Registration successful! You can now log in.";
            } else {
                // Passwort-Hashing
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                // Bereite die SQL-Anweisung vor, um SQL-Injection zu vermeiden
                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                if (!$stmt) {
                    echo "Prepare failed: " . $conn->error . "<br>";
                } else {
                    $stmt->bind_param("sss", $user, $hashed_password, $email);

                    if ($stmt->execute()) {
                        echo "Registration successful! You can now log in.<br>";
                    } else {
                        echo "Error executing query: " . $stmt->error . "<br>";
                    }
                }
            }

            $stmt->close();
        }
    } else {
        echo "Register button not set.<br>";
    }
} else {
    echo "Request method not POST.<br>";
}

$conn->close();
?>