/**
 * Protect Children Australia Website
 * Main JavaScript file
 * 
 * This file contains all client-side functionality for the website,
 * including interactive elements, form validation, animations, and
 * user experience enhancements.
 */

// Wait until DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initBackToTop();
    initScrollAnimations();
    initEmergencyCallLinks();
    initAccordions();
    initTabs();
    initFormValidation();
    initAccessibilityEnhancements();
});

/**
 * Back to Top Button Functionality
 * Shows/hides the back to top button based on scroll position
 */
function initBackToTop() {
    const backToTopButton = document.querySelector('.back-to-top');
    
    if (!backToTopButton) return;
    
    // Show back to top button when scrolled down 300px
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });
    
    // Smooth scroll to top when button is clicked
    backToTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Scroll-based Animations
 * Animates elements when they come into view while scrolling
 */
function initScrollAnimations() {
    // Select all elements with the animation classes
    const animatedElements = document.querySelectorAll('.fade-in, .slide-in-up');
    
    if (animatedElements.length === 0) return;
    
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    // Stop observing once animation is triggered
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1 // Trigger when 10% of the element is visible
        });
        
        animatedElements.forEach(element => {
            // Add initial state class
            element.classList.add('waiting-animation');
            observer.observe(element);
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        animatedElements.forEach(element => {
            element.classList.add('animated');
        });
    }
}

/**
 * Emergency Call Links
 * Makes emergency phone numbers clickable on mobile devices
 */
function initEmergencyCallLinks() {
    // Check if it's a mobile device
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    
    if (isMobile) {
        const emergencyContacts = document.querySelectorAll('.emergency-contacts li, .emergency-banner p');
        
        emergencyContacts.forEach(contact => {
            // Look for phone number patterns and make them clickable
            const content = contact.innerHTML;
            const phoneRegex = /(\b000\b|\b1800 \d{2} \d{4}\b|\b13 \d{2} \d{2}\b|\b1300 \d{2} \d{4}\b)/g;
            
            contact.innerHTML = content.replace(phoneRegex, '<a href="tel:$1" class="emergency-phone">$1</a>');
        });
    }
}

/**
 * Accordion Functionality
 * Handles expanding/collapsing accordion elements
 */
function initAccordions() {
    const accordionToggles = document.querySelectorAll('.accordion-toggle');
    
    if (accordionToggles.length === 0) return;
    
    accordionToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            // Toggle active class on the button
            this.classList.toggle('active');
            
            // Find the accordion content
            const content = this.nextElementSibling;
            
            // Toggle the max-height to show/hide content
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                this.setAttribute('aria-expanded', 'false');
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });
}

/**
 * Tab Functionality
 * Handles switching between tab content
 */
function initTabs() {
    const tabGroups = document.querySelectorAll('.tab-group');
    
    if (tabGroups.length === 0) return;
    
    tabGroups.forEach(group => {
        const tabs = group.querySelectorAll('.tab');
        const tabContents = group.querySelectorAll('.tab-content');
        
        tabs.forEach((tab, index) => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to current tab and content
                this.classList.add('active');
                tabContents[index].classList.add('active');
                
                // Update ARIA attributes
                tabs.forEach(t => t.setAttribute('aria-selected', 'false'));
                this.setAttribute('aria-selected', 'true');
            });
        });
    });
}

/**
 * Form Validation
 * Validates forms before submission
 */
function initFormValidation() {
    // Contact form validation
    const contactForm = document.querySelector('#contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', validateContactForm);
    }
    
    // Newsletter form validation
    const newsletterForm = document.querySelector('form[action*="newsletter-subscribe.php"]');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', validateNewsletterForm);
    }
    
    // Registration form validation
    const registrationForm = document.querySelector('#registration-form');
    if (registrationForm) {
        registrationForm.addEventListener('submit', validateRegistrationForm);
    }
}

/**
 * Contact Form Validation
 * @param {Event} e - Form submission event
 */
function validateContactForm(e) {
    const form = e.target;
    let isValid = true;
    
    // Clear previous error messages
    clearFormErrors(form);
    
    // Validate name
    const nameInput = form.querySelector('input[name="name"]');
    if (nameInput && nameInput.value.trim() === '') {
        showError(nameInput, 'Please enter your name');
        isValid = false;
    }
    
    // Validate email
    const emailInput = form.querySelector('input[name="email"]');
    if (emailInput) {
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
    }
    
    // Validate subject
    const subjectInput = form.querySelector('input[name="subject"]');
    if (subjectInput && subjectInput.value.trim() === '') {
        showError(subjectInput, 'Please enter a subject');
        isValid = false;
    }
    
    // Validate message
    const messageInput = form.querySelector('textarea[name="message"]');
    if (messageInput && messageInput.value.trim() === '') {
        showError(messageInput, 'Please enter your message');
        isValid = false;
    }
    
    // Prevent form submission if validation fails
    if (!isValid) {
        e.preventDefault();
    }
}

/**
 * Newsletter Form Validation
 * @param {Event} e - Form submission event
 */
function validateNewsletterForm(e) {
    const form = e.target;
    let isValid = true;
    
    // Clear previous error messages
    clearFormErrors(form);
    
    // Validate name (if present)
    const nameInput = form.querySelector('input[name="name"]');
    if (nameInput && nameInput.value.trim() === '') {
        showError(nameInput, 'Please enter your name');
        isValid = false;
    }
    
    // Validate email
    const emailInput = form.querySelector('input[name="email"]');
    if (emailInput) {
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
    }
    
    // Prevent form submission if validation fails
    if (!isValid) {
        e.preventDefault();
    }
}

/**
 * Registration Form Validation
 * @param {Event} e - Form submission event
 */
function validateRegistrationForm(e) {
    const form = e.target;
    let isValid = true;
    
    // Clear previous error messages
    clearFormErrors(form);
    
    // Validate username
    const usernameInput = form.querySelector('input[name="username"]');
    if (usernameInput && usernameInput.value.trim() === '') {
        showError(usernameInput, 'Please enter a username');
        isValid = false;
    }
    
    // Validate email
    const emailInput = form.querySelector('input[name="email"]');
    if (emailInput) {
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
    }
    
    // Validate password
    const passwordInput = form.querySelector('input[name="password"]');
    if (passwordInput && passwordInput.value.length < 8) {
        showError(passwordInput, 'Password must be at least 8 characters long');
        isValid = false;
    }
    
    // Validate password confirmation
    const confirmInput = form.querySelector('input[name="confirm_password"]');
    if (confirmInput && passwordInput && confirmInput.value !== passwordInput.value) {
        showError(confirmInput, 'Passwords do not match');
        isValid = false;
    }
    
    // Prevent form submission if validation fails
    if (!isValid) {
        e.preventDefault();
    }
}

/**
 * Check if email is valid
 * @param {string} email - Email address to validate
 * @return {boolean} True if email is valid
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Show error message for form field
 * @param {Element} input - Input element
 * @param {string} message - Error message
 */
function showError(input, message) {
    // Create error message element
    const errorElement = document.createElement('div');
    errorElement.className = 'invalid-feedback';
    errorElement.textContent = message;
    
    // Add error class to input
    input.classList.add('is-invalid');
    
    // Insert error message after input
    input.parentNode.insertBefore(errorElement, input.nextSibling);
    
    // Focus the first invalid input
    if (!document.querySelector('.is-invalid:focus')) {
        input.focus();
    }
}

/**
 * Clear all error messages in a form
 * @param {Element} form - Form element
 */
function clearFormErrors(form) {
    const errorMessages = form.querySelectorAll('.invalid-feedback');
    const invalidInputs = form.querySelectorAll('.is-invalid');
    
    errorMessages.forEach(element => element.remove());
    invalidInputs.forEach(input => input.classList.remove('is-invalid'));
}

/**
 * Accessibility Enhancements
 * Improves website accessibility for all users
 */
function initAccessibilityEnhancements() {
    // Add keyboard navigation for dropdown menus
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('keydown', function(e) {
            // Open dropdown on Enter or Space
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).dropdown('toggle');
            }
        });
    });
    
    // Make sure all interactive elements have appropriate ARIA attributes
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        if (!button.hasAttribute('type')) {
            button.setAttribute('type', 'button');
        }
    });
    
    // Add skip link focus handling
    const skipLink = document.querySelector('.skip-link');
    if (skipLink) {
        skipLink.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.tabIndex = -1;
                target.focus();
            }
        });
    }
}

/**
 * Additional Utility Functions
 */

// Debounce function to limit how often a function can be called
function debounce(func, delay) {
    let timeout;
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}

// Add event listener for page load complete
window.addEventListener('load', function() {
    // Hide page loader if it exists
    const pageLoader = document.querySelector('.page-loader');
    if (pageLoader) {
        pageLoader.classList.add('loaded');
        setTimeout(() => {
            pageLoader.style.display = 'none';
        }, 500);
    }
    
    // Initialize any components that need the full page to be loaded
    initLazyLoading();
});

/**
 * Lazy Loading Images
 * Improves page load performance by loading images only when needed
 */
function initLazyLoading() {
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
            img.classList.add('loaded');
        });
    }
}

