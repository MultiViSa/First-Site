<?php
// Verbindungsparameter zur Datenbank
$host = '192.168.123.20';
$dbname = 'Test';
$username = 'azubi';
$password = 'azubi';

try {
    // Verbindung zur Datenbank herstellen
    $pdo = new PDO("mysql:192.168.123.20=$host;Test=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Daten aus dem Formular erhalten
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

   $sql = "SELECT id FROM user WHERE username='$user' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Benutzername oder E-Mail bereits vergeben.";
    } else { 
    
    // SQL-Abfrage zum Einfügen des Benutzers
    $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$user, $email, $pass]);

    echo "Registrierung erfolgreich!";
} catch (PDOException $e) {
    die("Fehler: " . $e->getMessage());
}

$conn->close();
?>
