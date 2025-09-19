/**
 * Reviews and Likes Modal JavaScript
 * Handles interactive functionality for reviews and likes
 */

class ReviewsLikesModal {
    constructor() {
        this.init();
    }

    init() {
        this.createModalHTML();
        this.bindEvents();
    }

    createModalHTML() {
        // Create modal HTML structure
        const modalHTML = `
            <div id="reviewsModal" class="modal-overlay">
                <div class="modal-container">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            <i class="fa fa-star"></i>
                            Customer Reviews
                        </h2>
                        <button class="modal-close" onclick="reviewsModal.close()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-content" id="reviewsContent">
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            <p>Loading reviews...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="likesModal" class="modal-overlay">
                <div class="modal-container">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            <i class="fa fa-heart"></i>
                            People Who Liked Our Work
                        </h2>
                        <button class="modal-close" onclick="reviewsModal.close()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-content" id="likesContent">
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            <p>Loading likes...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="projectsModal" class="modal-overlay">
                <div class="modal-container">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            <i class="fa fa-building"></i>
                            Our Projects Portfolio
                        </h2>
                        <button class="modal-close" onclick="reviewsModal.close()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-content" id="projectsContent">
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            <p>Loading projects...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="clientsModal" class="modal-overlay">
                <div class="modal-container">
                    <div class="modal-header">
                        <h2 class="modal-title">
                            <i class="fa fa-users"></i>
                            Our Valued Clients
                        </h2>
                        <button class="modal-close" onclick="reviewsModal.close()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-content" id="clientsContent">
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            <p>Loading clients...</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Add modal HTML to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    bindEvents() {
        // Bind click events to statistics
        document.addEventListener('DOMContentLoaded', () => {
            this.addClickableClass();
        });
    }

    addClickableClass() {
        // Find all statistics elements by text content
        const factTexts = document.querySelectorAll('.facts-text');
        factTexts.forEach(element => {
            const text = element.textContent.toLowerCase();
            
            if (text.includes('reviews')) {
                element.classList.add('clickable-stat');
                element.addEventListener('click', () => this.showReviews());
            }
            if (text.includes('likes')) {
                element.classList.add('clickable-stat');
                element.addEventListener('click', () => this.showLikes());
            }
            if (text.includes('projects')) {
                element.classList.add('clickable-stat');
                element.addEventListener('click', () => this.showProjects());
            }
            if (text.includes('clients')) {
                element.classList.add('clickable-stat');
                element.addEventListener('click', () => this.showClients());
            }
        });
    }

    async showReviews() {
        const modal = document.getElementById('reviewsModal');
        const content = document.getElementById('reviewsContent');
        
        // Show modal
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        try {
            // Fetch reviews data
            const response = await fetch('reviews-likes-api.php?action=get_reviews');
            const data = await response.json();

            if (data.success) {
                this.renderReviews(data.data);
            } else {
                this.showError('Failed to load reviews');
            }
        } catch (error) {
            console.error('Error loading reviews:', error);
            this.showError('Error loading reviews');
        }
    }

    async showLikes() {
        const modal = document.getElementById('likesModal');
        const content = document.getElementById('likesContent');
        
        // Show modal
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        try {
            // Fetch likes data
            const response = await fetch('reviews-likes-api.php?action=get_likes');
            const data = await response.json();

            if (data.success) {
                this.renderLikes(data.data);
            } else {
                this.showError('Failed to load likes');
            }
        } catch (error) {
            console.error('Error loading likes:', error);
            this.showError('Error loading likes');
        }
    }

    async showProjects() {
        const modal = document.getElementById('projectsModal');
        const content = document.getElementById('projectsContent');
        
        // Show modal
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        try {
            // Fetch projects data
            const response = await fetch('reviews-likes-api.php?action=get_projects');
            const data = await response.json();

            if (data.success) {
                this.renderProjects(data.data);
            } else {
                this.showError('Failed to load projects');
            }
        } catch (error) {
            console.error('Error loading projects:', error);
            this.showError('Error loading projects');
        }
    }

    async showClients() {
        const modal = document.getElementById('clientsModal');
        const content = document.getElementById('clientsContent');
        
        // Show modal
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        try {
            // Fetch clients data
            const response = await fetch('reviews-likes-api.php?action=get_clients');
            const data = await response.json();

            if (data.success) {
                this.renderClients(data.data);
            } else {
                this.showError('Failed to load clients');
            }
        } catch (error) {
            console.error('Error loading clients:', error);
            this.showError('Error loading clients');
        }
    }

    renderReviews(reviews) {
        const content = document.getElementById('reviewsContent');
        
        if (reviews.length === 0) {
            content.innerHTML = `
                <div class="empty-state">
                    <i class="fa fa-star-o"></i>
                    <h3>No Reviews Yet</h3>
                    <p>Be the first to leave a review!</p>
                </div>
            `;
            return;
        }

        const reviewsHTML = reviews.map(review => `
            <div class="review-item">
                <div class="review-header">
                    <div class="review-avatar">
                        ${review.name.charAt(0).toUpperCase()}
                    </div>
                    <div class="review-info">
                        <h4>${review.name}</h4>
                        <p>${review.location}</p>
                    </div>
                </div>
                <div class="review-rating">
                    ${this.generateStars(review.rating)}
                </div>
                <div class="review-text">
                    "${review.review}"
                </div>
                <div class="review-meta">
                    <span class="review-project">${review.project_type}</span>
                    <span class="review-date">${this.formatDate(review.date)}</span>
                </div>
            </div>
        `).join('');

        content.innerHTML = reviewsHTML;
    }

    renderLikes(likes) {
        const content = document.getElementById('likesContent');
        
        if (likes.length === 0) {
            content.innerHTML = `
                <div class="empty-state">
                    <i class="fa fa-heart-o"></i>
                    <h3>No Likes Yet</h3>
                    <p>Be the first to like our work!</p>
                </div>
            `;
            return;
        }

        const likesHTML = `
            <div class="likes-grid">
                ${likes.map(like => `
                    <div class="like-item">
                        <div class="like-avatar">
                            ${like.name.charAt(0).toUpperCase()}
                        </div>
                        <div class="like-name">${like.name}</div>
                        <div class="like-location">${like.location}</div>
                        <div class="like-project">${like.project}</div>
                        <div class="like-date">${this.formatDate(like.liked_on)}</div>
                    </div>
                `).join('')}
            </div>
        `;

        content.innerHTML = likesHTML;
    }

    renderProjects(projects) {
        const content = document.getElementById('projectsContent');
        
        if (projects.length === 0) {
            content.innerHTML = `
                <div class="empty-state">
                    <i class="fa fa-building-o"></i>
                    <h3>No Projects Yet</h3>
                    <p>Our portfolio is growing!</p>
                </div>
            `;
            return;
        }

        const projectsHTML = projects.map(project => `
            <div class="project-item">
                <div class="project-header">
                    <img src="${project.image}" alt="${project.title}" class="project-image">
                    <div class="project-info">
                        <h3>${project.title}</h3>
                        <p><strong>Client:</strong> ${project.client}</p>
                        <p><strong>Location:</strong> ${project.location}</p>
                        <p><strong>Type:</strong> ${project.type}</p>
                    </div>
                </div>
                
                <div class="project-meta">
                    <div class="meta-item">
                        <div class="meta-label">Area</div>
                        <div class="meta-value">${project.area}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Duration</div>
                        <div class="meta-value">${project.duration}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Budget</div>
                        <div class="meta-value">${project.budget}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Status</div>
                        <div class="meta-value">${project.status}</div>
                    </div>
                </div>
                
                <div class="project-description">
                    ${project.description}
                </div>
                
                <div class="project-features">
                    ${project.features.map(feature => `<span class="feature-tag">${feature}</span>`).join('')}
                </div>
            </div>
        `).join('');

        content.innerHTML = projectsHTML;
    }

    renderClients(clients) {
        const content = document.getElementById('clientsContent');
        
        if (clients.length === 0) {
            content.innerHTML = `
                <div class="empty-state">
                    <i class="fa fa-users"></i>
                    <h3>No Clients Yet</h3>
                    <p>We're building our client base!</p>
                </div>
            `;
            return;
        }

        const clientsHTML = `
            <div class="clients-grid">
                ${clients.map(client => `
                    <div class="client-item">
                        <div class="client-status">${client.status}</div>
                        <div class="client-avatar">
                            ${client.avatar}
                        </div>
                        <div class="client-name">${client.name}</div>
                        <div class="client-location">${client.location}</div>
                        <div class="client-type">${client.type}</div>
                        
                        <div class="client-stats">
                            <div class="client-stat">
                                <div class="client-stat-value">${client.projects}</div>
                                <div class="client-stat-label">Projects</div>
                            </div>
                            <div class="client-stat">
                                <div class="client-stat-value">${client.total_value}</div>
                                <div class="client-stat-label">Total Value</div>
                            </div>
                        </div>
                        
                        <div class="client-contact">
                            <div class="client-phone">
                                <i class="fa fa-phone"></i>
                                ${client.phone}
                            </div>
                            <div class="client-email">
                                <i class="fa fa-envelope"></i>
                                ${client.email}
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;

        content.innerHTML = clientsHTML;
    }

    generateStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<i class="fa fa-star star"></i>';
            } else {
                stars += '<i class="fa fa-star-o star"></i>';
            }
        }
        return stars;
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    showError(message) {
        const content = document.getElementById('reviewsContent') || document.getElementById('likesContent');
        content.innerHTML = `
            <div class="empty-state">
                <i class="fa fa-exclamation-triangle"></i>
                <h3>Error</h3>
                <p>${message}</p>
            </div>
        `;
    }

    close() {
        // Close all modals
        const modals = document.querySelectorAll('.modal-overlay');
        modals.forEach(modal => {
            modal.classList.remove('active');
        });
        
        // Restore body scroll
        document.body.style.overflow = '';
    }
}

// Initialize the modal system
const reviewsModal = new ReviewsLikesModal();

// Close modal when clicking outside
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-overlay')) {
        reviewsModal.close();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        reviewsModal.close();
    }
});

// Add some additional interactive effects
document.addEventListener('DOMContentLoaded', () => {
    // Add hover effects to statistics
    const statItems = document.querySelectorAll('.fact-counter > div');
    statItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.style.transform = 'scale(1.05)';
            item.style.transition = 'all 0.3s ease';
        });
        
        item.addEventListener('mouseleave', () => {
            item.style.transform = 'scale(1)';
        });
    });
});
