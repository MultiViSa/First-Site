<?php
//Datenbankverbindung herstellen 
$servername = "debian";
$username = "USER1";
$password = "MYSQL1234";
$dbname = "Test";

//Verbindung erstellen
$conn = new mysql($servername, $username, $password, $dbname);

//Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

//SQL_Anweisungen zum EInfügen der Benutzerdaten
$spl = "INSERT INTO test (username, password) VALUES ('$user', '$pass')";

if($conn->query($sql) === TRUE) {
    echo "Registrierung erfolgreich!";
} else {
    echo "Fehler: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
