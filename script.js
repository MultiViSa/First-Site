document.addEventListener('DOMContentLoaded', function() {
    // Nachricht-Element finden
    var responseBox = document.getElementById('response-box');
    
    // Überprüfen, ob das Nachricht-Element existiert
    if (responseBox) {
        // Finde alle Buttons oder spezifische Buttons anhand ihrer ID oder Klasse
        var buttons = document.querySelectorAll('button');
        
        // Füge jedem Button einen Klick-Event-Listener hinzu
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (responseBox) {
                    responseBox.style.display = 'none';
                }
            });
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    var responseBox = document.getElementById('response-box');
    var closeButton = document.getElementById('close-btn');
    console.log("x functions")
    if (closeButton) {
        console.log("closeButton detected")
        closeButton.addEventListener('click', function() {
            if (responseBox) {
                responseBox.style.display = 'none';
                console.log("closed")
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var retryButton = document.getElementById('error-button');  // Der Retry-Button
    var wrapper = document.querySelector('.wrapper');           // Der Wrapper, der die Forms enthält
    
    if (retryButton) {
        retryButton.addEventListener('click', function() {
            // Aktion bei Klick auf den Retry-Button: Login-Section öffnen
            wrapper.classList.remove('active'); // Entfernt die "active" Klasse (falls Registration offen)
            wrapper.classList.add('active-popup'); // Fügt die Klasse hinzu, um den Login anzuzeigen
        });
    } else {
        console.log("Retry button not found");
    }
});


// Existierender Code für das Handling der Seitenumstellung und Popups
document.addEventListener('DOMContentLoaded', function() {
    var wrapper = document.querySelector('.wrapper');
    if (wrapper) {
        var loginLink = document.querySelector('.login-link');
        var registerLink = document.querySelector('.register-link');
        var btnPopup = document.querySelector('.btnLogin-popup');
        var iconClose = document.querySelector('.icon-close');

        if (loginLink) {
            loginLink.addEventListener('click', function() {
                wrapper.classList.remove('active');
            });
        }

        if (registerLink) {
            registerLink.addEventListener('click', function() {
                wrapper.classList.add('active');
            });
        }

        if (btnPopup) {
            btnPopup.addEventListener('click', function() {
                wrapper.classList.add('active-popup');
            });
        }

        if (iconClose) {
            iconClose.addEventListener('click', function() {
                wrapper.classList.remove('active-popup');
            });
        }
    }
});
