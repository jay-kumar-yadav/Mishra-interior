class MishraInteriorChatbot {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.isTyping = false;
        this.init();
    }
    
    init() {
        this.createChatbotHTML();
        this.bindEvents();
        this.addWelcomeMessage();
    }
    
    createChatbotHTML() {
        const chatbotHTML = `
            <div id="mishra-chatbot" class="mishra-chatbot">
                <!-- Chat Button -->
                <div id="chatbot-toggle" class="chatbot-toggle">
                    <i class="fa fa-comments"></i>
                    <span class="chatbot-badge">1</span>
                </div>
                
                <!-- Chat Window -->
                <div id="chatbot-window" class="chatbot-window">
                    <div class="chatbot-header">
                        <div class="chatbot-avatar">
                            <img src="image/logo.jpg" alt="Mishra Interior">
                        </div>
                        <div class="chatbot-info">
                            <h4>Mishra Interior Assistant</h4>
                            <span class="status">Online</span>
                        </div>
                        <button id="chatbot-close" class="chatbot-close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="chatbot-messages" id="chatbot-messages">
                        <!-- Messages will be added here -->
                    </div>
                    
                    <div class="chatbot-input-container">
                        <div class="chatbot-typing" id="chatbot-typing" style="display: none;">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="chatbot-input-wrapper">
                            <input type="text" id="chatbot-input" placeholder="Ask about our services..." maxlength="500">
                            <button id="chatbot-send" class="chatbot-send">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="chatbot-suggestions">
                            <button class="suggestion-btn" data-message="What services do you offer?">Services</button>
                            <button class="suggestion-btn" data-message="What are your prices?">Pricing</button>
                            <button class="suggestion-btn" data-message="How can I contact you?">Contact</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
    }
    
    bindEvents() {
        // Toggle chatbot
        document.getElementById('chatbot-toggle').addEventListener('click', () => {
            this.toggleChatbot();
        });
        
        // Close chatbot
        document.getElementById('chatbot-close').addEventListener('click', () => {
            this.closeChatbot();
        });
        
        // Send message
        document.getElementById('chatbot-send').addEventListener('click', () => {
            this.sendMessage();
        });
        
        // Send message on Enter key
        document.getElementById('chatbot-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
        
        // Suggestion buttons
        document.querySelectorAll('.suggestion-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const message = e.target.getAttribute('data-message');
                document.getElementById('chatbot-input').value = message;
                this.sendMessage();
            });
        });
        
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (this.isOpen && !e.target.closest('#mishra-chatbot')) {
                this.closeChatbot();
            }
        });
    }
    
    addWelcomeMessage() {
        const welcomeMessage = {
            type: 'bot',
            content: [
                'Hello! Welcome to Mishra Interior! 🏠',
                'I\'m here to help you with information about our interior design services.',
                'You can ask me about:',
                '• Our services (wallpaper, wooden flooring, wall painting, etc.)',
                '• Pricing and quotes',
                '• Contact information',
                '• Project portfolio',
                '• Materials and warranties',
                '',
                'How can I assist you today?'
            ],
            timestamp: new Date()
        };
        
        this.addMessage(welcomeMessage);
    }
    
    toggleChatbot() {
        if (this.isOpen) {
            this.closeChatbot();
        } else {
            this.openChatbot();
        }
    }
    
    openChatbot() {
        this.isOpen = true;
        document.getElementById('chatbot-window').classList.add('open');
        document.getElementById('chatbot-toggle').classList.add('active');
        document.getElementById('chatbot-input').focus();
        
        // Hide badge
        document.querySelector('.chatbot-badge').style.display = 'none';
        
        // Scroll to bottom
        this.scrollToBottom();
    }
    
    closeChatbot() {
        this.isOpen = false;
        document.getElementById('chatbot-window').classList.remove('open');
        document.getElementById('chatbot-toggle').classList.remove('active');
    }
    
    async sendMessage() {
        const input = document.getElementById('chatbot-input');
        const message = input.value.trim();
        
        if (!message || this.isTyping) return;
        
        // Add user message
        const userMessage = {
            type: 'user',
            content: [message],
            timestamp: new Date()
        };
        
        this.addMessage(userMessage);
        input.value = '';
        
        // Show typing indicator
        this.showTyping();
        
        try {
            const response = await fetch('chatbot/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: message })
            });
            
            const data = await response.json();
            
            // Hide typing indicator
            this.hideTyping();
            
            if (data.status === 'success') {
                // Add bot response
                const botMessage = {
                    type: 'bot',
                    content: data.response,
                    timestamp: new Date()
                };
                
                this.addMessage(botMessage);
            } else {
                // Error response
                const errorMessage = {
                    type: 'bot',
                    content: ['Sorry, I encountered an error. Please try again or contact us directly at +919945623419.'],
                    timestamp: new Date()
                };
                
                this.addMessage(errorMessage);
            }
        } catch (error) {
            console.error('Chatbot error:', error);
            this.hideTyping();
            
            const errorMessage = {
                type: 'bot',
                content: ['Sorry, I\'m having trouble connecting. Please contact us directly at +919945623419 for immediate assistance.'],
                timestamp: new Date()
            };
            
            this.addMessage(errorMessage);
        }
    }
    
    addMessage(message) {
        this.messages.push(message);
        
        const messagesContainer = document.getElementById('chatbot-messages');
        const messageElement = this.createMessageElement(message);
        messagesContainer.appendChild(messageElement);
        
        this.scrollToBottom();
    }
    
    createMessageElement(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${message.type}`;
        
        const timeStr = message.timestamp.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        
        let contentHTML = '';
        if (Array.isArray(message.content)) {
            contentHTML = message.content.map(line => 
                line ? `<p>${this.escapeHtml(line)}</p>` : '<br>'
            ).join('');
        } else {
            contentHTML = `<p>${this.escapeHtml(message.content)}</p>`;
        }
        
        messageDiv.innerHTML = `
            <div class="message-content">
                ${contentHTML}
            </div>
            <div class="message-time">${timeStr}</div>
        `;
        
        return messageDiv;
    }
    
    showTyping() {
        this.isTyping = true;
        document.getElementById('chatbot-typing').style.display = 'block';
        this.scrollToBottom();
    }
    
    hideTyping() {
        this.isTyping = false;
        document.getElementById('chatbot-typing').style.display = 'none';
    }
    
    scrollToBottom() {
        const messagesContainer = document.getElementById('chatbot-messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize chatbot when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new MishraInteriorChatbot();
});
