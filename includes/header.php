<?php
/**
 * Header template for all pages
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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

// Get page title from variable or use default
$pageTitle = isset($pageTitle) ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME;
$pageDescription = isset($pageDescription) ? $pageDescription : SITE_DESCRIPTION;
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS; ?>">
    <meta name="author" content="<?php echo SITE_NAME; ?>">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="<?php echo $pageTitle; ?>">
    <meta property="og:description" content="<?php echo $pageDescription; ?>">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/images/logo.png">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo SITE_URL; ?>/images/logo.png" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/styles.css">
    
    <?php if (isset($extraStyles)): ?>
        <?php echo $extraStyles; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="skip-link">Skip to main content</a>
    
    <!-- Emergency Contact Banner -->
    <div class="emergency-banner">
        <div class="container">
            <p class="text-center mb-0">
                <strong>Emergency?</strong> Call 000 | Kids Helpline: 1800 55 1800 | Lifeline: 13 11 14
            </p>
        </div>
    </div>

    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-4">
                    <a href="<?php echo SITE_URL; ?>" class="logo-link">
                        <img src="<?php echo SITE_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?> Logo" class="img-fluid site-logo">
                        <span class="site-name"><?php echo SITE_NAME; ?></span>
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="header-right d-flex justify-content-end align-items-center">
                        <!-- Search Form -->
                        <form action="<?php echo SITE_URL; ?>/search.php" method="get" class="search-form me-3">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        
                        <!-- User Menu or Login/Register Links -->
                        <div class="user-menu">
                            <?php if (isLoggedIn()): ?>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user me-1"></i> <?php echo $_SESSION['username']; ?>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/account.php">My Account</a></li>
                                        <?php if (isAdmin()): ?>
                                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/">Admin Dashboard</a></li>
                                        <?php endif; ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <a href="<?php echo SITE_URL; ?>/login.php" class="btn btn-outline-primary me-2">Login</a>
                                <a href="<?php echo SITE_URL; ?>/register.php" class="btn btn-primary">Register</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Include Navigation -->
        <?php include_once INCLUDE_PATH . '/navbar.php'; ?>
    </header>
    
    <!-- Main Content Container -->
    <main id="main-content" class="main-content py-4">
        <div class="container">
            <?php
            // Display messages if they exist in session
            if (isset($_SESSION['success_message'])) {
                echo displaySuccess($_SESSION['success_message']);
                unset($_SESSION['success_message']);
            }
            
            if (isset($_SESSION['error_message'])) {
                echo displayError($_SESSION['error_message']);
                unset($_SESSION['error_message']);
            }
            ?>

