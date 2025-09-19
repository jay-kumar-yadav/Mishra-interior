/**
 * Statistics Widget for Mishra Interior
 * Automatically track and update statistics
 */

class StatsWidget {
    constructor(apiKey, baseUrl = '') {
        this.apiKey = apiKey;
        this.baseUrl = baseUrl;
        this.stats = {};
        this.init();
    }
    
    init() {
        this.loadStats();
        this.setupEventListeners();
    }
    
    async loadStats() {
        try {
            const response = await fetch(`${this.baseUrl}chatbot/stats-api.php?action=get&key=${this.apiKey}`);
            const data = await response.json();
            
            if (data.success) {
                this.stats = data.data;
                this.updateDisplay();
            }
        } catch (error) {
            console.error('Failed to load statistics:', error);
        }
    }
    
    async incrementStat(statName, amount = 1) {
        try {
            const response = await fetch(`${this.baseUrl}chatbot/stats-api.php?action=increment&key=${this.apiKey}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    stat: statName,
                    amount: amount
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.stats = data.data;
                this.updateDisplay();
                this.showNotification(`Updated ${statName}: ${data.old_value} → ${data.new_value}`);
                return true;
            } else {
                console.error('Failed to increment stat:', data.error);
                return false;
            }
        } catch (error) {
            console.error('Failed to increment stat:', error);
            return false;
        }
    }
    
    updateDisplay() {
        // Update any elements with data-stat attributes
        document.querySelectorAll('[data-stat]').forEach(element => {
            const statName = element.getAttribute('data-stat');
            if (this.stats[statName] !== undefined) {
                element.textContent = this.stats[statName];
            }
        });
        
        // Update counter animations if they exist
        if (typeof $ !== 'undefined' && $.fn.countTo) {
            $('.counter').each(function() {
                const $this = $(this);
                const statName = $this.data('stat');
                if (statName && statsWidget.stats[statName] !== undefined) {
                    $this.countTo({
                        to: statsWidget.stats[statName],
                        speed: 2000,
                        refreshInterval: 50
                    });
                }
            });
        }
    }
    
    setupEventListeners() {
        // Track form submissions as potential new clients
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form.classList.contains('contact-form') || form.classList.contains('enquiry-form')) {
                // Increment clients after a short delay (assuming form submission is successful)
                setTimeout(() => {
                    this.incrementStat('clients', 1);
                }, 2000);
            }
        });
        
        // Track project completion (if you have project completion buttons)
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('project-complete-btn')) {
                this.incrementStat('projects', 1);
            }
        });
        
        // Track social media likes (if you have like buttons)
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('like-btn')) {
                this.incrementStat('likes', 1);
            }
        });
        
        // Track review submissions
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form.classList.contains('review-form')) {
                setTimeout(() => {
                    this.incrementStat('reviews', 1);
                }, 2000);
            }
        });
    }
    
    showNotification(message) {
        // Create a simple notification
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10000;
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 300px;
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    // Public methods for manual tracking
    trackNewClient() {
        return this.incrementStat('clients', 1);
    }
    
    trackNewProject() {
        return this.incrementStat('projects', 1);
    }
    
    trackNewLike(amount = 1) {
        return this.incrementStat('likes', amount);
    }
    
    trackNewReview() {
        return this.incrementStat('reviews', 1);
    }
    
    // Get current statistics
    getStats() {
        return this.stats;
    }
}

// Auto-initialize if API key is provided
if (typeof MISHRA_STATS_API_KEY !== 'undefined') {
    window.statsWidget = new StatsWidget(MISHRA_STATS_API_KEY);
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = StatsWidget;
}
