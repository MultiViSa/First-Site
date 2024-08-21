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

    // Debug-Ausgabe für übergebene Daten
        echo 'Übergebener Benutzername: ' . htmlspecialchars($user) . '<br>';
        echo 'Übergebenes Passwort: ' . htmlspecialchars($pass) . '<br>';

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // SQL-Abfrage zur Überprüfung des Benutzers
    $stmt = $pdo->prepare("SELECT password FROM user WHERE username = ?");
    $stmt->execute([$user]);

    // Überprüfen, ob eine Zeile zurückgegeben wurde
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug-Ausgabe für Benutzername und Passwort
        echo 'Benutzername aus DB: ' . htmlspecialchars($user) . '<br>';
        echo 'Passwort aus DB: ' . htmlspecialchars($row['password']) . '<br>';

        if (password_verify($pass, $row['password'])) {
            echo "Anmeldung erfolgreich!";
        } else {
            echo "Ungültiger Benutzername oder Passwort!";
        }
    } else {
        echo "Benutzername nicht gefunden!";
    }
} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}
?>
