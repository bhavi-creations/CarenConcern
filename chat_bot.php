<!-- Chatbot Icon -->
<div id="chatbot-icon" style="position:fixed; bottom:20px; right:20px; z-index:1000; cursor:pointer;">
    <img src="https://img.icons8.com/color/48/000000/chat.png" alt="Chatbot" style="width:60px; height:60px;">
</div>

<!-- Chatbot Popup -->
<div id="chatbot-popup" style="display:none; position:fixed; bottom:90px; right:20px; width:300px; max-height:400px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.2); background:#fff; overflow:hidden; z-index:1001; font-family:Arial, sans-serif;">
    <div style="background:#28a745; color:#fff; padding:10px; font-weight:bold; display:flex; justify-content:space-between; align-items:center;">
        Care ‘n’ Concern Family Dental Clinic
        <span id="close-chat" style="cursor:pointer;">✖</span>
    </div>
    <div id="chat-content" style="padding:10px; height:300px; overflow-y:auto; background:#f5f5f5;">
        <div class="chat-message bot-message" style="margin-bottom:10px; padding:5px 10px; background:#e0e0e0; border-radius:10px;">
            Welcome to Care ‘n’ Concern Family Dental Clinic! How can we help you today?
        </div>
        <div style="margin-top:10px;">
            <strong>Our Services:</strong>
            <ul id="service-list" style="padding-left:20px; margin-top:5px;">
                <li class="service-item" data-content="We provide quality dental cleaning and oral checkups.">Dental Cleaning</li>
                <li class="service-item" data-content="Our tooth extraction is safe, pain-free, and comfortable.">Tooth Extraction</li>
                <li class="service-item" data-content="We provide root canal treatment with advanced technology.">Root Canal</li>
                <li class="service-item" data-content="We offer dental implants to replace missing teeth.">Dental Implants</li>
            </ul>
        </div>
    </div>
    <div id="chat-footer" style="padding:10px; background:#fff; border-top:1px solid #ddd; font-size:14px;">
        For more details, contact Care ‘n’ Concern Family Dental Clinic: <br>
        <strong>+91 9876543210</strong>
    </div>
</div>

<script>
    const chatbotIcon = document.getElementById('chatbot-icon');
    const chatbotPopup = document.getElementById('chatbot-popup');
    const closeChat = document.getElementById('close-chat');
    const serviceItems = document.querySelectorAll('.service-item');
    const chatContent = document.getElementById('chat-content');

    // Toggle chatbot popup
    chatbotIcon.addEventListener('click', () => {
        chatbotPopup.style.display = chatbotPopup.style.display === 'none' ? 'block' : 'none';
    });

    closeChat.addEventListener('click', () => {
        chatbotPopup.style.display = 'none';
    });

    // Service click event
    serviceItems.forEach(item => {
        item.addEventListener('click', () => {
            const content = item.getAttribute('data-content');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message bot-message';
            messageDiv.style.marginBottom = '10px';
            messageDiv.style.padding = '5px 10px';
            messageDiv.style.background = '#e0e0e0';
            messageDiv.style.borderRadius = '10px';
            messageDiv.textContent = content;
            chatContent.appendChild(messageDiv);

            // Scroll to bottom
            chatContent.scrollTop = chatContent.scrollHeight;
        });
    });
</script>
