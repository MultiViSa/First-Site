// Existierender Code für das Handling der Seitenumstellung und Popups
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', () => {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
});


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

    if (closeButton) {
        closeButton.addEventListener('click', function() {
            if (responseBox) {
                responseBox.style.display = 'none';
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
