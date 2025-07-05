<?php
/**
 * Navigation bar template for all pages
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Get all categories for the navigation menu
$categories = getAllCategories();
?>

<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                
                <!-- Safety Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSafety" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-shield-alt me-1"></i> Safety Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownSafety">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo SITE_URL; ?>/category.php?slug=<?php echo $category['slug']; ?>">
                                    <?php echo $category['name']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                
                <!-- Resources -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'resources.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/resources.php">
                        <i class="fas fa-book me-1"></i> Resources
                    </a>
                </li>
                
                <!-- Blog -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'blog.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/blog.php">
                        <i class="fas fa-blog me-1"></i> Blog
                    </a>
                </li>
                
                <!-- Emergency Info -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'emergency.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/emergency.php">
                        <i class="fas fa-ambulance me-1"></i> Emergency Info
                    </a>
                </li>
                
                <!-- For Parents -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'for-parents.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/for-parents.php">
                        <i class="fas fa-users me-1"></i> For Parents
                    </a>
                </li>
                
                <!-- For Educators -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'for-educators.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/for-educators.php">
                        <i class="fas fa-chalkboard-teacher me-1"></i> For Educators
                    </a>
                </li>
                
                <!-- About Us -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAbout" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-info-circle me-1"></i> About
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAbout">
                        <li>
                            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/about.php">About Us</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/mission.php">Our Mission</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/team.php">Our Team</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?php echo SITE_URL; ?>/faqs.php">FAQs</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="<?php echo SITE_URL; ?>/contact.php">
                        <i class="fas fa-envelope me-1"></i> Contact
                    </a>
                </li>
            </ul>
            
            <!-- Action Button - Always visible on desktop, collapses on mobile -->
            <div class="d-none d-lg-block">
                <a href="<?php echo SITE_URL; ?>/report-concern.php" class="btn btn-danger">
                    <i class="fas fa-exclamation-triangle me-1"></i> Report a Concern
                </a>
            </div>
        </div>
        
        <!-- Action Button - Always visible, even when navbar is collapsed on mobile -->
        <a href="<?php echo SITE_URL; ?>/report-concern.php" class="btn btn-danger d-lg-none ms-2">
            <i class="fas fa-exclamation-triangle"></i>
        </a>
    </div>
</nav>

