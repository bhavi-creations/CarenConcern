<!DOCTYPE html>
<html lang="te">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care n Concern Family Dental Clinic  Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* చాట్‌బాట్ ఐకాన్ స్థానం మరియు స్టైలింగ్ */
        #chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000; /* ఇతర ఎలిమెంట్స్ పైన ఉండటానికి */
            cursor: pointer;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #007bff; /* బ్లూ రంగు */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        #chatbot-icon:hover {
            transform: scale(1.05);
        }

        /* చాట్ విండో స్టైలింగ్ */
        #chatbot-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 450px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 999;
            display: none; /* మొదట్లో దాచి ఉంచడానికి */
            flex-direction: column;
            overflow: hidden;
        }

        /* చాట్ హెడర్ */
        #chat-header {
            /* background-color: #0056b3; ముదురు బ్లూ */
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* చాట్ బాడీ (మెసేజెస్) */
        #chat-body {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto; /* స్క్రోలింగ్ కోసం */
            background-color: #f8f9fa; /* లేత గ్రే */
        }

        /* యూజర్ మెసేజ్ స్టైల్ */
        .user-msg {
            text-align: right;
        }
        /* బాట్ మెసేజ్ స్టైల్ */
        .bot-msg {
            text-align: left;
        }

        .message-bubble {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 15px;
            margin-bottom: 8px;
            max-width: 80%;
        }

        .bot-bubble {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
        }

        /* సర్వీస్ బటన్స్ */
        .service-btn {
            width: 100%;
            margin-bottom: 5px;
            /* background-color: #007bff;
            border-color: #007bff;
            color: white; */
        }
    </style>
</head>
<body>

<div id="chatbot-icon" onclick="toggleChatbot()">
    <i class="fas fa-tooth fa-2x"></i> 
</div>

<div id="chatbot-window">
    <div id="chat-header">
        <span>Care n Concern Family Dental Clinic  Chatbot</span>
        <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="toggleChatbot()"></button>
    </div>
    <div id="chat-body">
        </div>
    <div id="chat-input" class="p-2">
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const chatBody = document.getElementById('chat-body');
    const chatbotWindow = document.getElementById('chatbot-window');
    
    // హాస్పిటల్ సంప్రదింపు నంబర్
    const contactNumber = '+91 98765 43210'; 
    
    // సర్వీసుల డేటా
    const services = {
        'RCT': {
            name: 'రూట్ కెనాల్ ట్రీట్‌మెంట్ (RCT)',
            content: "రూట్ కెనాల్ ట్రీట్‌మెంట్ అనేది పంటి లోపలి భాగానికి (పల్ప్) ఇన్ఫెక్షన్ సోకినప్పుడు చేసే చికిత్స. దీనివల్ల పంటిని కోల్పోకుండా కాపాడుకోవచ్చు. ఈ ట్రీట్‌మెంట్ నొప్పి లేకుండా సమర్థవంతంగా చేయబడుతుంది.",
        },
        'Implants': {
            name: 'డెంటల్ ఇంప్లాంట్స్',
            content: "డెంటల్ ఇంప్లాంట్స్ అనేది కోల్పోయిన పంటిని శాశ్వతంగా భర్తీ చేసే ప్రక్రియ. ఇది సహజమైన పంటిలాగా కనిపిస్తుంది, పనిచేస్తుంది. ఇది మీ నవ్వుకు మరియు నమలడానికి బలాన్నిస్తుంది.",
        },
        'Scaling': {
            name: 'పళ్ళు శుభ్రం చేయించడం (Scaling)',
            content: "పళ్ళు శుభ్రం చేయించడం (Scaling) ద్వారా పళ్ళ చుట్టూ పేరుకుపోయిన పాచి (ప్లాక్) మరియు గార (టార్టార్) ను తొలగించవచ్చు. ఇది చిగుళ్ళ వ్యాధులు రాకుండా కాపాడుతుంది మరియు నోటి ఆరోగ్యాన్ని మెరుగుపరుస్తుంది.",
        },
        'Braces': {
            name: 'ఆర్థోడోంటిక్స్ (Braces)',
            content: "ఆర్థోడోంటిక్స్ (Braces) ద్వారా వంకరగా ఉన్న పళ్ళను సరళంగా మార్చవచ్చు. ఇది మీ నవ్వును అందంగా చేస్తుంది మరియు ఆహారాన్ని నమలడం సులభం అవుతుంది. మెటల్ మరియు అదృశ్య బ్రేసెస్‌లో చికిత్స అందుబాటులో ఉంది.",
        },
    };

    // 1. చాట్‌బాట్‌ను తెరవడం/మూసివేయడం
    function toggleChatbot() {
        if (chatbotWindow.style.display === 'flex') {
            chatbotWindow.style.display = 'none';
        } else {
            chatbotWindow.style.display = 'flex';
            // తెరిచినప్పుడు మాత్రమే స్వాగత సందేశం చూపించాలి
            displayWelcomeMessage(); 
        }
    }

    // 2. మెసేజ్‌ను చాట్‌లో చూపించడం
    function appendMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add(`${sender}-msg`);
        
        const bubble = document.createElement('span');
        bubble.classList.add('message-bubble');
        if (sender === 'bot') {
            bubble.classList.add('bot-bubble');
        }
        
        bubble.innerHTML = text;
        messageDiv.appendChild(bubble);
        chatBody.appendChild(messageDiv);
        
        // స్క్రోల్ డౌన్
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    // 3. స్వాగత సందేశం మరియు సర్వీస్ బటన్లను చూపించడం
    function displayWelcomeMessage() {
        // చాట్ బాడీని ఖాళీ చేయండి
        chatBody.innerHTML = ''; 

        const welcomeText = "Hi! Welcome to **Care n Concern Family Dental Clinic.** మా సేవలను తెలుసుకోవడానికి, దయచేసి కింద ఉన్న **సర్వీసెస్‌**లో మీకు కావాల్సిన ట్రీట్‌మెంట్‌ను ఎంచుకోండి.";
        appendMessage(welcomeText, 'bot');

        // సర్వీస్ బటన్లను చూపించడానికి ఒక setTimeout వాడండి, బాట్ మెసేజ్ తర్వాత అవి కనిపిస్తాయి
        setTimeout(() => {
            const buttonsContainer = document.createElement('div');
            buttonsContainer.className = 'text-center mt-3';

            Object.keys(services).forEach(key => {
                const btn = document.createElement('button');
                btn.className = 'btn service-btn btn-sm';
                btn.textContent = services[key].name;
                btn.onclick = () => showServiceDetails(key);
                buttonsContainer.appendChild(btn);
            });
            
            chatBody.appendChild(buttonsContainer);
            chatBody.scrollTop = chatBody.scrollHeight; // స్క్రోల్ డౌన్
        }, 500); 
    }

    // 4. సర్వీస్ వివరాలను చూపించడం
    function showServiceDetails(serviceKey) {
        const service = services[serviceKey];
        
        // యూజర్ క్లిక్ చేసిన మెసేజ్ (డైనమిక్)
        const userClickedMsg = `నేను ${service.name} గురించి తెలుసుకోవాలనుకుంటున్నాను.`;
        appendMessage(userClickedMsg, 'user'); 

        // సర్వీస్ కంటెంట్
        const contentMessage = service.content;
        
        // కాంటాక్ట్ వివరాలు
        const contactMessage = `
            ${contentMessage}
            <hr>
            **మరిన్ని వివరాల కోసం:**
            **Care n Concern Family Dental Clinic **ను సంప్రదించండి.
            **సంప్రదించవలసిన నంబర్:** <a href="tel:${contactNumber}" class="text-white">${contactNumber}</a>
        `;
        
        setTimeout(() => {
            appendMessage(contactMessage, 'bot');
            
            // మళ్లీ మెయిన్ మెనూ చూపించే బటన్
            const restartBtnContainer = document.createElement('div');
            restartBtnContainer.className = 'text-center mt-3';
            const restartBtn = document.createElement('button');
            restartBtn.className = 'btn btn-success btn-sm';
            restartBtn.textContent = 'మెయిన్ మెనూకు తిరిగి వెళ్లండి';
            restartBtn.onclick = displayWelcomeMessage;
            restartBtnContainer.appendChild(restartBtn);
            
            chatBody.appendChild(restartBtnContainer);
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 800);
    }
    
    // పేజీ లోడ్ అయిన వెంటనే చాట్‌బాట్‌ను దాచి ఉంచండి
    document.addEventListener('DOMContentLoaded', () => {
        chatbotWindow.style.display = 'none';
    });
</script>

</body>
</html>