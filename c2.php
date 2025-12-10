<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care N Concern Chatbot</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Chatbot Icon Positioning and Styling (Black/White) */
        #chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            cursor: pointer;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #000000; /* Black */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s;
        }

        #chatbot-icon:hover {
            transform: scale(1.05);
        }

        /* Chat Window Styling (Black/White) */
        #chatbot-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 450px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #000; /* Outer border */
        }

        /* Chat Header (Black/White) */
        #chat-header {
            background-color: #333333; /* Dark Gray/Black */
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Chat Body (Messages) */
        #chat-body {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #ffffff; /* White background */
        }

        /* Message Styling */
        .user-msg {
            text-align: right;
        }
        .bot-msg {
            text-align: left;
        }

        .message-bubble {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 15px;
            margin-bottom: 8px;
            max-width: 90%;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* Bot bubble (Light Gray/White) */
        .bot-bubble {
            background-color: #eeeeee;
            border: 1px solid #cccccc;
            color: #333;
        }
        /* User bubble (White/Black text) */
        .user-msg .message-bubble {
            background-color: #000000; 
            color: white;
        }
        
        /* Service Buttons (Black/White) */
        .service-btn {
            width: 100%;
            margin-bottom: 8px;
            background-color: #000000; /* Black button */
            border-color: #000000;
            color: white;
            font-size: 0.9rem;
            white-space: normal;
            height: auto;
            min-height: 40px;
            padding: 8px;
        }
        /* Hover effect */
        .service-btn:hover {
            background-color:#333333;
            color: white !important;
            border-color: #333333;
            
        }
        
        /* Contact link color adjustment */
        .bot-bubble a {
             color: #000000 !important; /* Contact link in black */
             text-decoration: underline !important;
        }
        
    </style>
</head>
<body>

<div id="chatbot-icon" onclick="toggleChatbot()">
    <i class="fas fa-tooth fa-2x"></i> 
</div>

<div id="chatbot-window">
    <div id="chat-header">
        <span>Care N Concern Family dental Hospital</span>
        <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="toggleChatbot()"></button>
    </div>
    <div id="chat-body">
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const chatBody = document.getElementById('chat-body');
    const chatbotWindow = document.getElementById('chatbot-window');
    
    // Hospital Contact Information
    const contactNumber = '+91 98458 02787'; 
    const hospitalName = 'Care N Concern Family Dental Hospital';
    
    // Service Data based on your list
    const services = {
        'BasalImplant': {
            name: 'Basal Implants',
            content: "Basal Implants are a modern technique offering immediate loading for tooth replacement, especially suitable for patients with severe bone loss. You can often get fixed teeth within days.",
        },
        'TeethWhitening': {
            name: 'Teeth Whitening',
            content: "Teeth Whitening is a safe procedure to lighten the shade of your teeth and remove stains, giving you a brighter and more confident smile.",
        },
        'LaserDentistry': {
            name: 'Laser Dentistry',
            content: "Laser Dentistry involves using precise lasers for various dental procedures, resulting in minimal pain, faster healing, and often eliminating the need for sutures.",
        },
        'ClearAligners': {
            name: 'Clear Aligners',
            content: "Clear Aligners are a discreet way to straighten your teeth without traditional metal braces. They are custom-made, virtually invisible, and removable.",
        },
        'RootCanal': {
            name: 'Root Canal',
            content: "Root Canal Treatment (RCT) is performed to repair and save a tooth that is badly decayed or infected, preventing the need for extraction.",
        },
        'TeethCleaning': {
            name: 'Teeth Cleaning',
            content: "Professional Teeth Cleaning (Scaling and Polishing) removes plaque and tartar buildup, preventing gum disease and maintaining optimal oral hygiene.",
        },
        'CrownsBridges': {
            name: 'Crowns & Bridges',
            content: "Dental Crowns are caps placed over a damaged tooth, while Bridges are used to replace one or more missing teeth. Both restore function and aesthetics.",
        },
        'PainlessRemoval': {
            name: 'Painless Teeth Removal',
            content: "We use advanced techniques and local anesthesia to ensure a comfortable and painless teeth removal process when extraction is absolutely necessary.",
        },
        'Fillings': {
            name: 'Tooth Colored Fillings',
            content: "Tooth Colored Fillings (Composite Fillings) are used to restore decayed teeth, matching the natural color of your teeth for a seamless look.",
        },
        'JawFractures': {
            name: 'Fixing Jaw Fractures',
            content: "We provide specialized treatment for managing and fixing jaw fractures resulting from trauma or injury, ensuring proper alignment and recovery.",
        },
    };

    // 1. Toggle Chatbot Open/Close
    function toggleChatbot() {
        if (chatbotWindow.style.display === 'flex') {
            chatbotWindow.style.display = 'none';
        } else {
            chatbotWindow.style.display = 'flex';
            // Display welcome message only when opening
            displayWelcomeMessage(); 
        }
    }

    // 2. Append Message to Chat Body
    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add(`${sender}-msg`);
        
        const bubble = document.createElement('span');
        bubble.classList.add('message-bubble');
        if (sender === 'bot') {
            bubble.classList.add('bot-bubble');
        }
        
        // Use innerHTML to process the contact link and bold tags (using **)
        bubble.innerHTML = text; 
        messageDiv.appendChild(bubble);
        chatBody.appendChild(messageDiv);
        
        // Scroll to the bottom
        chatBody.scrollTop = chatBody.scrollHeight;
        return messageDiv; // Return the message element for sequential display
    }

    // 3. Display Welcome Message and Service Buttons
    function displayWelcomeMessage() {
        // Clear chat body
        chatBody.innerHTML = ''; 

        // Welcome message content
        const welcomeText = `Hi! Welcome to ${hospitalName}. Please select a service from the options below to know more about our treatments.`;

        // 1. First, show ONLY the welcome message
        appendMessage(welcomeText, 'bot');

        // 2. After a short delay, show the service buttons
        setTimeout(() => {
            const buttonsContainer = document.createElement('div');
            buttonsContainer.className = 'text-center mt-3';

            // Create buttons for each service
            Object.keys(services).forEach(key => {
                const btn = document.createElement('button');
                btn.className = 'btn service-btn btn-sm';
                btn.textContent = services[key].name;
                btn.onclick = () => showServiceDetails(key);
                buttonsContainer.appendChild(btn);
            });
            
            chatBody.appendChild(buttonsContainer);
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 800); // 800ms delay so the user reads the message first
    }

    // 4. Show Service Details
    function showServiceDetails(serviceKey) {
        const service = services[serviceKey];
        
        // User's message (dynamically clicked)
        const userClickedMsg = `Tell me more about ${service.name}.`;
        appendMessage(userClickedMsg, 'user'); 

        // Service Content and Contact Information
        const contentMessage = service.content;
        
        const contactMessage = `
            ${contentMessage}
            <hr>
            **For more details, please contact ${hospitalName}.**
            **Contact Number:** <a href="tel:${contactNumber}" style="color: black; text-decoration: underline; font-weight: bold;">${contactNumber}</a>
        `;
        
        setTimeout(() => {
            appendMessage(contactMessage, 'bot');
            
            // Button to return to the main menu
            const restartBtnContainer = document.createElement('div');
            restartBtnContainer.className = 'text-center mt-3';
            const restartBtn = document.createElement('button');
            restartBtn.className = 'btn btn-secondary btn-sm'; /* Changed to secondary for B/W theme */
            restartBtn.style.backgroundColor = '#333';
            restartBtn.style.borderColor = '#333';
            restartBtn.textContent = 'Back to Main Menu';
            restartBtn.onclick = displayWelcomeMessage;
            restartBtnContainer.appendChild(restartBtn);
            
            chatBody.appendChild(restartBtnContainer);
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 800);
    }
    
    // Ensure the chatbot is closed on initial load
    document.addEventListener('DOMContentLoaded', () => {
        chatbotWindow.style.display = 'none';
    });
</script>

</body>
</html>