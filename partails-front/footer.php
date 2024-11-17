 <!-- Chat Icon (Initial button in the bottom-right corner) -->
  <div id="chat-icon" onclick="toggleChatWindow()">
    <img src="image/chatbot-icon.png" alt="Chat Icon" id="chat-icon-img">
  </div>

  <!-- Chat Window -->
  <div id="assistant-container" style="display:none;">
    <div id="chatbox">
      <div id="chat-window">
        <div class="chat-message bot">
          <p>Hello! Welcome to Twins Cafe Virtual Assistant. How can I help you today?</p>
        </div>
      </div>
    </div>
    <input type="text" id="user-input" placeholder="Ask me anything..." />
    <button id="send-btn">Send</button>
  </div>
  <style type="text/css">
      * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  position: relative; /* Make sure the body allows absolute positioning */
}

#chat-icon {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #4caf50;
  border-radius: 50%;
  padding: 10px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#chat-icon img {
  width: 40px;
  height: 40px;
}

#assistant-container {
  position: fixed;
  bottom: 80px; /* Move chat window above the icon */
  right: 20px;
  background-color: white;
  border: 2px solid #ccc;
  border-radius: 8px;
  width: 350px;
  max-width: 100%;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

#chatbox {
  max-height: 400px;
  overflow-y: auto;
  margin-bottom: 10px;
}

#chat-window {
  display: flex;
  flex-direction: column;
}

.chat-message {
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  max-width: 80%;
}

.chat-message.bot {
  background-color: #f0f0f0;
  align-self: flex-start;
}

.chat-message.user {
  background-color: #4caf50;
  color: white;
  align-self: flex-end;
}

#user-input {
  width: 80%;
  padding: 10px;
  border: 2px solid #ccc;
  border-radius: 5px;
}

#send-btn {
  width: 15%;
  padding: 10px;
  border: none;
  background-color: #4caf50;
  color: white;
  border-radius: 5px;
  cursor: pointer;
}

#send-btn:hover {
  background-color: #45a049;
}

  </style>


    <!-- Footer Section -->
    <footer class="footer bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12 mb-4 text-center">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <!-- Facebook -->
                        <li><a href="#" class="text-white"><i class="fab fa-facebook fa-2x" style="color: #3b5998;"></i>  Facebook</a></li>
                        <!-- instagram -->
                        <li><a href="#" class="text-white"><i class="fab fa-instagram fa-2x" style="color: #C13584;"></i>  Instagram</a></li>
                        <!-- Twitter -->
                        <li><a href="#" class="text-white"><i class="fab fa-twitter fa-2x" style="color: #1DA1F2;"></i> Twitter</a></li>
                        <!-- WhatsApp -->
                        <li><a href="#" class="text-white"><i class="fab fa-whatsapp fa-2x" style="color: #25D366;"></i>  Whatsapp</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-12 mb-4 text-center">
                    <h5>Contact Us</h5>
                    <p> Address: Munyonyo Center, Wavamuno Road</p>
                    <p>Phone: +256 740417681</p>
                    <p>Email: twinzcafe07@gmail.com</p>
                    <div id="status-message"></div>
                </div>
                <div class="col-md-4 col-12 mb-4 text-center">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="privacy.php" class="text-white">Privacy Policy</a></li>
                        <li><a href="FAQ.php" class="text-white">FAQ</a></li>
                        <li><a href="terms.php" class="text-white">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="text-center mt-3">
                <div class="footer-content">
                    <p>&copy; <?php echo date("Y"); ?> Twinz Cafe. All Rights Reserved.</p>
                </div>
            </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('menuButton').addEventListener('click', function() {
            document.getElementById('mobileNav').style.display = 'flex'; // Show mobile nav
        });

        document.getElementById('closeBtn').addEventListener('click', function() {
            document.getElementById('mobileNav').style.display = 'none'; // Hide mobile nav
        });
    </script>
    <script>
    let cart = [];
    let subtotal = 0;

    function addToCart(itemName, itemPrice) {
        cart.push({name: itemName, price: itemPrice});
        updateCart();
    }

    function updateCart() {
        const cartItemsElement = document.getElementById('cart-items');
        cartItemsElement.innerHTML = '';
        subtotal = 0;

        cart.forEach(item => {
            subtotal += item.price;
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `${item.name} <span>$${item.price.toFixed(2)}</span>`;
            cartItemsElement.appendChild(li);
        });

        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('total').textContent = `$${(subtotal + 2.40).toFixed(2)}`; // Including tax
    }

    function updateCafeStatus() {
    const statusMessage = document.getElementById('status-message');
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    const openHour = 8;
    const closeHour = 22;

    // Format function for display (e.g., 8:00 AM, 10:00 PM)
    function formatTime(hour, minute) {
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minute.toString().padStart(2, '0')} ${ampm}`;
    }

    if (currentHour < openHour || (currentHour === closeHour && currentMinute > 0) || currentHour > closeHour) {
        // If before 8:00 AM or after 10:00 PM
        statusMessage.textContent = `Closed: Opens at ${formatTime(openHour, 0)}`;
        statusMessage.style.color = 'red'; // Sets color to red when closed
    } else if (currentHour === openHour && currentMinute === 0) {
        // If exactly 8:00 AM
        statusMessage.textContent = `Now Open: ${formatTime(openHour, 0)}`;
        statusMessage.style.color = 'green'; // Sets color to green when just opened
    } else if (currentHour === closeHour && currentMinute >= 30) {
        // If it's between 9:30 PM and 10:00 PM
        statusMessage.textContent = `Closing Soon at ${formatTime(closeHour, 0)}`;
        statusMessage.style.color = 'orange'; // Sets color to orange when closing soon
    } else {
        // During open hours, from 8:00 AM to 10:00 PM
        statusMessage.textContent = `Now Open: Closes at ${formatTime(closeHour, 0)}`;
        statusMessage.style.color = 'green'; // Sets color to green during open hours
    }
}

// Update the status every minute
setInterval(updateCafeStatus, 60000);
updateCafeStatus(); // Initial call

//chat box
const sendBtn = document.getElementById('send-btn');
const userInput = document.getElementById('user-input');
const chatWindow = document.getElementById('chat-window');
const assistantContainer = document.getElementById('assistant-container');

// Predefined responses for the chatbot
const responses = {
  menu: "Our menu includes a variety of dishes, including vegan, gluten-free, and vegetarian options. Would you like to explore our menu today?",
  specials: "Today's specials include Grilled Salmon with Roasted Vegetables and a Vegan Chickpea Salad.",
  hours: "We are open every day from 8 AM to 10 PM. Come visit us!",
  location: "We are located at Munyonyo, Wavamuno Road, Munyonyo Center, After entering the main gate.",
  events: "Check out our monthly coffee-tasting events and live music on weekends. Visit our events page for more details.",
  reservations: "You can book a table through our website or simply ask me to reserve one for you.",
  contact: "Contact us on 0740417681.",
  feedback: "We love hearing from our customers! Feel free to share your feedback or suggestions anytime.",
  default: "Sorry, I didn't quite catch that. Could you please ask something else?"
};

// Function to create chat bubbles
function createChatBubble(message, sender) {
  const chatMessage = document.createElement('div');
  chatMessage.classList.add('chat-message', sender);
  chatMessage.innerHTML = `<p>${message}</p>`;
  chatWindow.appendChild(chatMessage);
  chatWindow.scrollTop = chatWindow.scrollHeight;
}

// Function to process user input and generate response
function getResponse(userText) {
  const text = userText.toLowerCase();

  if (text.includes("menu")) {
    return responses.menu;
  } else if (text.includes("specials")) {
    return responses.specials;
  } else if (text.includes("hours")) {
    return responses.hours;
  } else if (text.includes("location")) {
    return responses.location;
  } else if (text.includes("events")) {
    return responses.events;
  } else if (text.includes("reserve") || text.includes("reservation")) {
    return responses.reservations;
  } else if (text.includes("feedback")) {
    return responses.feedback;
  } else if (text.includes("contact")) {
    return responses.contact;
  } else {
    return responses.default;
  }
}

// Handle send button click
sendBtn.addEventListener('click', function() {
  const userText = userInput.value.trim();
  
  if (userText) {
    createChatBubble(userText, 'user');
    const botResponse = getResponse(userText);
    setTimeout(() => createChatBubble(botResponse, 'bot'), 500);
    userInput.value = '';
  }
});

// Handle Enter key press for sending message
userInput.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    sendBtn.click();
  }
});

// Toggle chat window visibility when the chat icon is clicked
function toggleChatWindow() {
  if (assistantContainer.style.display === "none" || assistantContainer.style.display === "") {
    assistantContainer.style.display = "block";
  } else {
    assistantContainer.style.display = "none";
  }
}

// Automatically open the chat window when the page loads
window.onload = function() {
  assistantContainer.style.display = "block"; // Ensure the chat window is open initially
};



</script>

</body>
</html>