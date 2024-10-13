function sendMessage() {
    const messageText = document.getElementById('messageText').value;
    const fileInput = document.getElementById('fileInput');
    const messageContainer = document.getElementById('messageContainer');

    if (messageText.trim() === '' && fileInput.files.length === 0) {
        return;
    }

    const messageElement = document.createElement('div');
    messageElement.className = 'message';

    if (messageText.trim() !== '') {
        messageElement.textContent = messageText;
    }

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const imageElement = document.createElement('img');
            imageElement.src = e.target.result;
            imageElement.className = 'message-image';
            messageElement.appendChild(imageElement);
        };

        reader.readAsDataURL(file);
    }

    messageContainer.appendChild(messageElement);
    messageContainer.scrollTop = messageContainer.scrollHeight; 

    document.getElementById('messageText').value = '';
    fileInput.value = ''; 
}
