<?php
// Verbindungsparameter zur Datenbank
$host = '192.168.123.20';
$host = 'debian';
$dbname = 'Test';
$username = 'azubi';
$password = 'azubi';

try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO("mysql:host=$host;port=8889;Test=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Daten aus dem Formular erhalten
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SQL-Abfrage zum Einfügen des Benutzers
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$user, $email, $pass]);

    echo "Registrierung erfolgreich!";
} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}
?>
