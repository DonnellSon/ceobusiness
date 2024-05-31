document.addEventListener("DOMContentLoaded", function() {
    var messenger = document.querySelector('.messenger');
    var messengerWindow = document.querySelector('.messenger-window');

    messenger.addEventListener("click", function() {
        if (messengerWindow.classList.contains('active')) {
            messengerWindow.classList.remove('active');
        } else {
            messengerWindow.classList.add('active'); 
            messengerWindow.style.transition = "opacity 2s ease"; 
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var messengerWindow = document.querySelector('.messenger-window');
    var messengerBtn = document.querySelector('.messenger');

    messengerBtn.addEventListener("click", function() {
        if (messengerWindow.style.display === "block") {
            messengerWindow.style.display = "none";
        } else {
            messengerWindow.style.display = "block";
        }
    });

    var closeBtn = document.querySelector('.close-btn');
    closeBtn.addEventListener("click", function() {
        messengerWindow.style.display = "none";
    });
});