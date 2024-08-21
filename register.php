<?php
// Verbindungsparameter zur Datenbank
$host = '192.168.123.20';
$dbname = 'Test';
$username = 'azubi';
$password = 'azubi';


try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Daten aus dem Formular erhalten
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // SQL-Abfrage zur Überprüfung des Benutzers
    $stmt = $pdo->prepare("SELECT passwort FROM user WHERE benutzername = ?");
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($pass, $row['password'])) {
        echo "Anmeldung erfolgreich!";
    } else {
        echo "Ungültiger Benutzername oder Passwort!";
    }
} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}
?>
