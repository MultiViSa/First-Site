<?php
if (isset($_SESSION['message'])) {
    $message_class = isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'success' ? 'success' : 'error';

    echo "<div id='response-box' class='response-box $message_class'>
            <span id='close-btn' class='bx bx-x'></span>
            <p>" . $_SESSION['message'] . "</p>";

                    // Überprüfe, ob der message_type 'error' ist und füge einen Button hinzu
            if (isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'error') {
                echo "<button id='error-button' class='retry-btn'>Retry</button>";
            }

          echo "</div>";

    
    unset($_SESSION['message']); // Nachricht nach dem Anzeigen löschen
    unset($_SESSION['message_type']); // Typ ebenfalls löschen
}
?>