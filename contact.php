<?php
/**
 * Contact Page for Protect Children Australia Website
 * 
 * This page features:
 * - Contact form with validation
 * - Direct contact information
 * - Map and address information
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Set page-specific variables
$pageTitle = 'Contact Us';
$pageDescription = 'Get in touch with Protect Children Australia for questions, support, or to report concerns about child safety issues.';

// Initialize variables for form fields
$name = $email = $subject = $message = $state = '';
$errors = [];
$success = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';
    $state = isset($_POST['state']) ? sanitizeInput($_POST['state']) : '';
    
    // Validate form data
    if (empty($name)) {
        $errors['name'] = 'Please enter your name';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Please enter your email address';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }
    
    if (empty($subject)) {
        $errors['subject'] = 'Please enter a subject';
    }
    
    if (empty($message)) {
        $errors['message'] = 'Please enter your message';
    }
    
    if (empty($state)) {
        $errors['state'] = 'Please select your state or territory';
    }
    
    // If no errors, insert into database
    if (empty($errors)) {
        $data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'state' => $state,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $result = insertRecord('contact_messages', $data);
        
        if ($result) {
            // Success message
            $success = true;
            
            // Clear form fields
            $name = $email = $subject = $message = $state = '';
            
            // Optional: Send email notification
            // mail(SITE_EMAIL, "New contact form submission: $subject", "Name: $name\nEmail: $email\nState: $state\n\nMessage:\n$message");
            
            // Set success message in session (will be displayed after redirect)
            $_SESSION['success_message'] = 'Thank you for your message. We will get back to you soon.';
            
            // Log activity
            logActivity('Contact form submission', "From: $name <$email>", 0);
            
            // Redirect to avoid form resubmission
            redirect('contact.php');
        } else {
            $errors['general'] = 'An error occurred while submitting your message. Please try again later.';
        }
    }
}

// Include header
include_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header bg-primary-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Contact Us</h1>
                <p class="lead">Get in touch with our team for questions, support, or to report concerns.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="contact-info py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="contact-info-card text-center h-100 p-4 bg-white shadow rounded">
                    <div class="contact-icon mb-3">
                        <i class="fas fa-phone-alt text-primary fa-3x"></i>
                    </div>
                    <h3>Phone</h3>
                    <p>For general inquiries:</p>
                    <p class="contact-detail">(02) 1234 5678</p>
                    <p>For urgent concerns:</p>
                    <p class="contact-detail">(02) 8765 4321</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="contact-info-card text-center h-100 p-4 bg-white shadow rounded">
                    <div class="contact-icon mb-3">
                        <i class="fas fa-envelope text-primary fa-3x"></i>
                    </div>
                    <h3>Email</h3>
                    <p>General information:</p>
                    <p class="contact-detail"><a href="mailto:info@protectchildren.com.au">info@protectchildren.com.au</a></p>
                    <p>Support requests:</p>
                    <p class="contact-detail"><a href="mailto:support@protectchildren.com.au">support@protectchildren.com.au</a></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="contact-info-card text-center h-100 p-4 bg-white shadow rounded">
                    <div class="contact-icon mb-3">
                        <i class="fas fa-map-marker-alt text-primary fa-3x"></i>
                    </div>
                    <h3>Address</h3>
                    <p>Our main office is located at:</p>
                    <p class="contact-detail">
                        123 Safety Street<br>
                        Sydney, NSW 2000<br>
                        Australia
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Notice -->
<section class="emergency-notice py-4 bg-secondary-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-danger mb-0">
                    <h4 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Important Notice</h4>
                    <p>If you or a child is in immediate danger, please call emergency services at <strong>000</strong> immediately. This contact form is not monitored 24/7 and is not suitable for emergency situations.</p>
                    <hr>
                    <p class="mb-0">For immediate support, call Kids Helpline at <strong>1800 55 1800</strong> or Lifeline at <strong>13 11 14</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="contact-form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="card-title text-center mb-4">Send Us a Message</h2>
                        
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                Thank you for your message. We will get back to you soon.
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($errors['general'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $errors['general']; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>" required>
                                    <?php if (isset($errors['name'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo $errors['name']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $email; ?>" required>
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo $errors['email']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php echo isset($errors['subject']) ? 'is-invalid' : ''; ?>" id="subject" name="subject" value="<?php echo $subject; ?>" required>
                                    <?php if (isset($errors['subject'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo $errors['subject']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="state" class="form-label">State/Territory <span class="text-danger">*</span></label>
                                    <select class="form-select <?php echo isset($errors['state']) ? 'is-invalid' : ''; ?>" id="state" name="state" required>
                                        <option value="" <?php echo empty($state) ? 'selected' : ''; ?>>Select your state/territory</option>
                                        <?php echo getStateOptions($state); ?>
                                    </select>
                                    <?php if (isset($errors['state'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo $errors['state']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>" id="message" name="message" rows="6" required><?php echo $message; ?></textarea>
                                <?php if (isset($errors['message'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors['message']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="privacy-policy" name="privacy-policy" required>
                                <label class="form-check-label" for="privacy-policy">
                                    I have read and agree to the <a href="privacy-policy.php" target="_blank">Privacy Policy</a> <span class="text-danger">*</span>
                                </label>
                                <div class="invalid-feedback">
                                    You must agree to our Privacy Policy to submit the form.
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="map-content p-4">
                                    <h3>Visit Our Office</h3>
                                    <p>Our office is open Monday to Friday, 9:00 AM to 5:00 PM AEST.</p>
                                    <address>
                                        <strong>Protect Children Australia</strong><br>
                                        123 Safety Street<br>
                                        Sydney, NSW 2000<br>
                                        Australia
                                    </address>
                                    <p>
                                        <strong>Phone:</strong> (02) 1234 5678<br>
                                        <strong>Email:</strong> <a href="mailto:info@protectchildren.com.au">info@protectchildren.com.au</a>
                                    </p>
                                    <p><small>Please note: Visits are by appointment only. Contact us to schedule a meeting.</small></p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <!-- Embedded Google Map (replace with actual embed code) -->
                                <div class="map-container ratio ratio-16x9">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.8536250394!2d151.20544997677146!3d-33.86832997322424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae401e8b983f%3A0x5017d681632ccc0!2sSydney%20NSW%202000!5e0!3m2!1sen!2sau!4v1706516309428!5m2!1sen!2sau" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Frequently Asked Questions</h2>
            <p class="lead">Find quick answers to common questions about contacting us</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="contactFaq">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-toggle accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What is the typical response time?
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#contactFaq">
                            <div class="accordion-body">
                                We aim to respond to all inquiries within 24-48 business hours. For urgent matters related to child safety, please call the emergency numbers provided above.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-toggle accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How do I report a concern about a child's safety?
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#contactFaq">
                            <div class="accordion-body">
                                If you have concerns about a child's immediate safety, please contact emergency services at 000. For non-emergency concerns, you can use our <a href="report-concern.php">Report a Concern</a> form, which is directed to our specialized team for prompt attention.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingThree">
                            <button class="accordion-toggle accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How is my contact information used?
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#contactFaq">
                            <div class="accordion-body">
                                Your contact information is used solely to respond to your inquiry and is handled according to our <a href="privacy-policy.php">Privacy Policy</a>. We never share your information with third parties without your explicit consent.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingFour">
                            <button class="accordion-toggle accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Can I request resources for my organization?
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#contactFaq">
                            <div class="accordion-body">
                                Yes, we offer resources for schools, community organizations, and other groups working with children. Please use this contact form with details about your organization and specific resource needs, and our team will get back to you.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Extra JavaScript for this page -->
<?php
$extraScripts = '
<script>
// Additional validation for contact form
document.addEventListener("DOMContentLoaded", function() {
    // Get the form element
    const form = document.getElementById("contact-form");
    
    if (form) {
        // Add event listener for form submission
        form.addEventListener("submit", function(event) {
            // Flag to track validation status
            let isValid = true;
            
            // Validate name
            const nameInput = form.querySelector("#name");
            if (nameInput.value.trim() === "") {
                showError(nameInput, "Please enter your name");
                isValid = false;
            } else {
                clearError(nameInput);
            }
            
            // Validate email
            const emailInput = form.querySelector("#email");
            if (emailInput.value.trim() === "") {
                showError(emailInput, "Please enter your email address");
                isValid = false;
            } else if (!isValidEmail(emailInput.value)) {
                showError(emailInput, "Please enter a valid email address");
                isValid = false;
            } else {
                clearError(emailInput);
            }
            
            // Validate subject
            const subjectInput = form.querySelector("#subject");
            if (subjectInput.value.trim() === "") {
                showError(subjectInput, "Please enter a subject");
                isValid = false;
            } else {
                clearError(subjectInput);
            }
            
            // Validate state selection
            const stateInput = form.querySelector("#state");
            if (stateInput.value === "") {
                showError(stateInput, "Please select your state or territory");
                isValid = false;
            } else {
                clearError(stateInput);
            }
            
            // Validate message
            const messageInput = form.querySelector("#message");
            if (messageInput.value.trim() === "") {
                showError(messageInput, "Please enter your message");
                isValid = false;
            } else {
                clearError(messageInput);
            }
            
            // Validate privacy policy checkbox
            const privacyCheckbox = form.querySelector("#privacy-policy");
            if (!privacyCheckbox.checked) {
                privacyCheckbox.nextElementSibling.nextElementSibling.style.display = "block";
                isValid = false;
            } else {
                privacyCheckbox.nextElementSibling.nextElementSibling.style.display = "none";
            }
            
            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // Real-time validation for email field
        const emailInput = form.querySelector("#email");
        if (emailInput) {
            emailInput.addEventListener("blur", function() {
                if (this.value.trim() !== "" && !isValidEmail(this.value)) {
                    showError(this, "Please enter a valid email address");
                } else if (this.value.trim() !== "") {
                    clearError(this);
                }
            });
        }
    }
    
    // Helper function to show error message
    function showError(input, message) {
        // Add error class to input
        input.classList.add("is-invalid");
        
        // Create or update error message
        let feedback = input.nextElementSibling;
        if (!feedback || !feedback.classList.contains("invalid-feedback")) {
            feedback = document.createElement("div");
            feedback.className = "invalid-feedback";
            input.parentNode.insertBefore(feedback, input.nextSibling);
        }
        feedback.textContent = message;
    }
    
    // Helper function to clear error message
    function clearError(input) {
        input.classList.remove("is-invalid");
        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains("invalid-feedback")) {
            feedback.textContent = "";
        }
    }
    
    // Helper function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});
</script>
';
?>

<?php
// Include footer
include_once 'includes/footer.php';
?>

