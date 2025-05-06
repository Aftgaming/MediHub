<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - Chatbot</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        section#chatbot {
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }
        #chat-window {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            height: 300px; /* Set height for chat window */
            background-color: white;
            overflow-y: auto; /* Enable scrolling */
            margin: 0 auto;
            width: 80%; /* Center the chat window */
            max-width: 600px; /* Max width for larger screens */
            display: flex;
            flex-direction: column;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .user-message {
            background-color: #e1f7d5;
            align-self: flex-end; /* Align user messages to the right */
        }
        .bot-message {
            background-color: #d1d1d1;
            align-self: flex-start; /* Align bot messages to the left */
        }
        .input-container {
            display: flex;
            margin-top: 10px;
        }
        .input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .input-container button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        /* Chatbot avatar style */
        #chatbot-avatar {
            width: 60px; /* Adjust the size of the avatar */
            border-radius: 50%; /* Make it circular */
            margin-bottom: 10px; /* Space between avatar and chat window */
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start the session

    // Check if the user is logged in
    $isLoggedIn = isset($_SESSION['email']); // Assuming you set the email in the session upon login
    ?>

<header class="d-flex flex-column" style="padding: 20px 150px;">
    <nav class="d-flex justify-content-end mb-2">
        <ul class="list-inline mb-0" style="font-size: 0.85rem;">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="services.php">Services</a></li>
            <li class="list-inline-item"><a href="about.php">About</a></li>
			<li class="list-inline-item"><a href="chatbot.php">Chatbot</a></li>
            <?php if (!$isLoggedIn): ?>
                <li class="list-inline-item" style="margin-right: 0px;"><a href="signup.php" class="d-flex align-items-center"><b>Sign Up</b></a></li>
                <li class="list-inline-item"><a href="login.php" class="d-flex align-items-center"><b>Log In</b></a></li>
            <?php else: ?>
                <li class="list-inline-item"><a href="profile.php" class="d-flex align-items-center"><b>Profile</b></a></li> <!-- Profile Button -->
                <li class="list-inline-item"><a href="logout.php" class="d-flex align-items-center"><b>Log Out</b></a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="d-flex align-items-center">
        <a href="index.php" class="d-flex align-items-center mr-3">
            <img src="images/logo.png" alt="MediHub Logo" style="height: 60px;"/> <!-- Adjust the logo path and size as needed -->
            <h1 style="margin: 0; margin-left: 10px; font-size: 1.8rem;">MediHub</h1> <!-- Clickable text logo -->
        </a>
        <input type="text" class="form-control mr-2" placeholder="MediHub Search..." aria-label="Search" style="max-width: 1000px;"/>
        <?php if (!$isLoggedIn): ?>
            <a href="login.php" class="btn btn-outline-success ml-auto" style="border: none;">
                <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/> <!-- Add to cart icon -->
            </a>
        <?php else: ?>
            <a href="cart.php" class="btn btn-outline-success ml-auto" style="border: none;">
                <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/> <!-- Add to cart icon -->
            </a>
        <?php endif; ?>
    </div>
</header>

    <section id="chatbot">
        <h2>Chat with Us</h2>
        <img id="chatbot-avatar" src="images/chatbot.jpg" alt="Chatbot Avatar"> <!-- Add chatbot avatar -->
        <div id="chat-window">
            <p class="bot-message">Hello! I'm here to help you. You can ask me about our services, pharmacy locations, or medicine prices.</p>
        </div>
        <div class="input-container">
            <input type="text" id="userInput" placeholder="Type your message..." required>
            <button id="sendButton">Send</button>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MediHub. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('sendButton').addEventListener('click', function() {
            const userInput = document.getElementById('userInput').value;
            if (userInput.trim() !== '') {
                addMessageToChat(userInput, 'user');
                document.getElementById('userInput').value = ''; // Clear input box
                respondToUser (userInput);
            }
        });

        document.getElementById('userInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                document.getElementById('sendButton').click(); // Trigger button click on Enter
            }
        });

        function addMessageToChat(message, sender) {
            const chatWindow = document.getElementById('chat-window');
            const messageDiv = document.createElement('p');
            messageDiv.classList.add('message');
            if (sender === 'user') {
                messageDiv.classList.add('user-message');
            } else {
                messageDiv.classList.add('bot-message');
            }
            messageDiv.textContent = message;
            chatWindow.appendChild(messageDiv);
            chatWindow.scrollTop = chatWindow.scrollHeight; // Auto-scroll to bottom
        }

        function respondToUser (input) {
            const response = generateResponse(input);
            addMessageToChat(response, 'bot');
        }

        function generateResponse(input) {
            const lowerInput = input.toLowerCase();
            if (lowerInput.includes('hello') || lowerInput.includes('hi')) {
                return "Hi there! How can I help you today?";
            } else if (lowerInput.includes('pharmacy')) {
                return "You can find local pharmacies using our services page or ask me for specific locations.";
            } else if (lowerInput.includes('medicine')) {
                return "You can check medicine prices on our services page. What medicine are you looking for?";
            } else if (lowerInput.includes('help')) {
                return "I'm here to assist you! You can ask about services, prices, or anything else related to healthcare.";
            } else if (lowerInput.includes('services')) {
                return "We offer a variety of health services, including medicine price checks and pharmacy locations. What would you like to know?";
            } else if (lowerInput.includes('thank you')) {
                return "You're welcome! If you have more questions, feel free to ask.";
            } else {
                return "Sorry, I didn't understand that. Can you please rephrase or ask about our services?";
            }
        }
    </script>
</body>
</html>