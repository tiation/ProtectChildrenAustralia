<?php
/**
 * Newsletter Subscription Handler for Protect Children Australia Website
 * 
 * This script processes newsletter subscription form submissions from:
 * - Homepage newsletter form
 * - Footer newsletter form
 * - Any other newsletter signup forms across the site
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start([
        'cookie_lifetime' => SESSION_LIFETIME,
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cookie_samesite' => 'Strict'
    ]);
}

// Initialize variables
$errors = [];
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;

// Process only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic CSRF protection
    if (!isset($_POST['_token']) || $_POST['_token'] !== session_id()) {
        $errors[] = 'Invalid form submission.';
    } else {
        // Get and sanitize form data
        $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
        $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
        
        // Validate email (required)
        if (empty($email)) {
            $errors[] = 'Email address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }
        
        // Validate name (optional)
        if (isset($_POST['name']) && empty($name)) {
            $errors[] = 'Name is required.';
        }
        
        // If no validation errors, proceed
        if (empty($errors)) {
            // Check if email already exists in database
            $sql = "SELECT id FROM newsletter_subscribers WHERE email = ?";
            $existingSubscriber = fetchSingle($sql, [$email]);
            
            if ($existingSubscriber) {
                // Email already subscribed - we'll treat this as a success to prevent email harvesting
                $_SESSION['success_message'] = 'Thank you for your interest in our newsletter!';
                redirect($referrer);
            }
            
            // Insert new subscriber
            $data = [
                'email' => $email,
                'name' => $name,
                'subscribed_at' => date('Y-m-d H:i:s')
            ];
            
            $result = insertRecord('newsletter_subscribers', $data);
            
            if ($result) {
                // Log the subscription
                logActivity('Newsletter subscription', "Email: $email", 0);
                
                // Set success message
                $_SESSION['success_message'] = 'Thank you for subscribing to our newsletter! You will receive updates and safety tips from us.';
                
                // Optional: Send a welcome email
                // sendWelcomeEmail($email, $name);
                
                // Redirect back to referring page
                redirect($referrer);
            } else {
                // Database error
                $errors[] = 'An error occurred while processing your subscription. Please try again later.';
            }
        }
    }
    
    // If there are errors, set error message in session and redirect back
    if (!empty($errors)) {
        $_SESSION['error_message'] = implode(' ', $errors);
        redirect($referrer);
    }
} else {
    // Not a POST request, redirect to homepage
    redirect(SITE_URL);
}

/**
 * Send welcome email to new subscribers
 * 
 * @param string $email Subscriber's email
 * @param string $name Subscriber's name
 * @return bool Success status
 */
function sendWelcomeEmail($email, $name) {
    // This is a placeholder function for sending welcome emails
    // In a production environment, you would implement a proper email sending system
    
    $subject = 'Welcome to the Protect Children Australia Newsletter';
    
    $message = "Hello " . ($name ? $name : 'there') . ",\n\n";
    $message .= "Thank you for subscribing to the Protect Children Australia newsletter.\n\n";
    $message .= "You will receive regular updates on child safety topics, resources, and tips to help keep children safe.\n\n";
    $message .= "If you have any questions or need assistance, please don't hesitate to contact us at " . SITE_EMAIL . ".\n\n";
    $message .= "Best regards,\n";
    $message .= "The Protect Children Australia Team\n";
    $message .= SITE_URL;
    
    $headers = 'From: ' . SITE_EMAIL . "\r\n" .
        'Reply-To: ' . SITE_EMAIL . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    return mail($email, $subject, $message, $headers);
}

// This script should not output anything directly
// All responses are handled through session messages and redirects

