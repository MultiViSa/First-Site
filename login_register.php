<?php
session_start(); // Session starten

// Fehlerberichterstattung aktivieren
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verbindungsdetails zur Datenbank
$servername = "localhost";
$username = "root";
$password = "azubi";
$dbname = "register";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login-Prozess
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // SQL-Abfrage zur Benutzerüberprüfung
        $sql = "SELECT * FROM users WHERE username='$user'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password']; // Das gehashte Passwort aus der DB

            if (password_verify($pass, $hashedPassword)) {
                $_SESSION['logged_in'] = true;  // Benutzer ist eingeloggt
                $_SESSION['username'] = $user;  // Benutzername speichern
                $_SESSION['message'] = "Login successful! Welcome back $user";
                $_SESSION['message_type'] = 'success';
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['message'] = "Invalid password.";
                $_SESSION['message_type'] = 'error';
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "User does not exist.";
            $_SESSION['message_type'] = 'error';
            header("Location: index.php");
            exit();
        }
    }
}

// Registrierungs-Prozess
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];

        // Überprüfen, ob Benutzername oder E-Mail bereits existiert
        $sql = "SELECT * FROM users WHERE username='$user' OR email='$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $_SESSION['message'] = "Email or username already exists.";
            $_SESSION['message_type'] = 'error';
        } else {
            // Passwort-Hashing (für sichere Passwortspeicherung)
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Benutzer in der Datenbank speichern
            $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$hashed_password', '$email')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = "Registration successful!";
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = "Error: " . $conn->error;
                $_SESSION['message_type'] = 'error';
            }
        }

        header("Location: dashboard.php");
        exit();
    }
}
?>
