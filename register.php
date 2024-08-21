<?php
//Datenbankverbindung herstellen 
$servername = "192.168.123.20";
$username = "azubi";
$password = "azubi";
$dbname = "Test";


try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO("mysql:servername=$servername;dbname=$dbname", $username, $password);
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
Beispiel für die Anmeldung (login.php):
php
Code kopieren
<?php
// Verbindungsparameter zur Datenbank
$host = 'localhost';
$dbname = 'deine_datenbank';
$username = 'dein_db_user';
$password = 'dein_db_pass';

try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Daten aus dem Formular erhalten
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // SQL-Abfrage zur Überprüfung des Benutzers
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
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
