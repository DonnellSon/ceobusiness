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
    var sendBtn = document.querySelector('.send-boutton');
    var messageInput = document.querySelector('.message-input');
    var messageContainer = document.querySelector('.message-container');

    sendBtn.addEventListener("click", function() {
        var userMessage = messageInput.value.trim(); 
        if (userMessage !== '') {
           
            appendMessage(userMessage, 'user');
           
            messageInput.value = '';
           
            messageContainer.scrollTop = messageContainer.scrollHeight;
           
            setTimeout(function() {
                var serviceMessage = "Désolé, ce service n'est pas encore disponible.";
                appendMessage(serviceMessage, 'service');
              
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }, 2000);
        }
    });

    function appendMessage(message, sender) {
      
        var messageElement = document.createElement('div');
    
        messageElement.classList.add(sender === 'user' ? 'user-message' : 'service-message');
      
        messageElement.textContent = message;
       
        messageContainer.appendChild(messageElement);
    }
});
