<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Wenn der Benutzer nicht eingeloggt ist, zurück zum Login
    header("Location: index.php");
    exit();
}

// Abmelde-Logik
if (isset($_POST['logout'])) {
    // Session beenden
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

include 'message_box.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2 class="logo">logo</h2>
    <nav class="navigation">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <form method="POST" style="display:inline;">
            <button type="submit" name="logout" class="btnLogout">Logout</button>
        </form>
    </nav>
</header>

<script src="script.js"></script>
</body>
</html>
