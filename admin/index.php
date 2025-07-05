<?php
/**
 * Admin Dashboard for Protect Children Australia Website
 * 
 * This is the main entry point for the admin area:
 * - Displays summary statistics
 * - Shows recent activities
 * - Provides navigation to all admin sections
 */

// Define base path constant and set admin flag
define('BASEPATH', true);
define('IS_ADMIN', true);

// Include required files
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

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

// Check if user is logged in and has admin role
if (!isLoggedIn()) {
    // Not logged in, redirect to login page
    $_SESSION['error_message'] = 'Please log in to access the admin area.';
    redirect(SITE_URL . '/login.php?redirect=admin');
} elseif (!isAdmin()) {
    // Logged in but not admin, redirect to home page with error
    $_SESSION['error_message'] = 'You do not have permission to access the admin area.';
    redirect(SITE_URL);
}

// Set page-specific variables
$pageTitle = 'Admin Dashboard';
$currentUser = getCurrentUser();

// Get statistics for dashboard
$stats = [];

// Total Posts
$postsResult = fetchSingle("SELECT COUNT(*) as count FROM posts");
$stats['posts'] = $postsResult ? $postsResult['count'] : 0;

// Total Categories
$categoriesResult = fetchSingle("SELECT COUNT(*) as count FROM categories");
$stats['categories'] = $categoriesResult ? $categoriesResult['count'] : 0;

// Total Resources
$resourcesResult = fetchSingle("SELECT COUNT(*) as count FROM resources");
$stats['resources'] = $resourcesResult ? $resourcesResult['count'] : 0;

// Total Subscribers
$subscribersResult = fetchSingle("SELECT COUNT(*) as count FROM newsletter_subscribers");
$stats['subscribers'] = $subscribersResult ? $subscribersResult['count'] : 0;

// Total Contact Messages
$messagesResult = fetchSingle("SELECT COUNT(*) as count FROM contact_messages");
$stats['messages'] = $messagesResult ? $messagesResult['count'] : 0;

// Total Users
$usersResult = fetchSingle("SELECT COUNT(*) as count FROM users");
$stats['users'] = $usersResult ? $usersResult['count'] : 0;

// Get recent activities (last 10)
// Recent Posts
$recentPosts = fetchAll("
    SELECT p.id, p.title, p.created_at, u.username as author
    FROM posts p
    JOIN users u ON p.author_id = u.id
    ORDER BY p.created_at DESC
    LIMIT 5
");

// Recent Contact Messages
$recentMessages = fetchAll("
    SELECT id, name, email, subject, created_at
    FROM contact_messages
    ORDER BY created_at DESC
    LIMIT 5
");

// Recent Subscribers
$recentSubscribers = fetchAll("
    SELECT id, email, name, subscribed_at
    FROM newsletter_subscribers
    ORDER BY subscribed_at DESC
    LIMIT 5
");

// Include admin header (this file would need to be created separately)
// For now, we'll include a simple HTML header directly in this file
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?> | <?php echo SITE_NAME; ?> Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/admin/css/admin-styles.css">
    
    <style>
        /* Basic admin styles - in a real implementation these would be in a separate CSS file */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        .admin-sidebar {
            width: 250px;
            background-color: #2d3436;
            color: #fff;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .admin-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .admin-sidebar .logo-container {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-sidebar .logo-container img {
            max-height: 40px;
        }
        
        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            transition: all 0.2s;
        }
        
        .admin-sidebar .nav-link:hover, 
        .admin-sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .admin-sidebar .nav-link i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }
        
        .admin-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        /* Mobile styles */
        @media (max-width: 767.98px) {
            .admin-sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }
            
            .admin-content {
                margin-left: 0;
            }
            
            .admin-sidebar.show {
                width: 250px;
                padding: initial;
            }
            
            .toggle-sidebar {
                display: block !important;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="logo-container">
                <a href="<?php echo SITE_URL; ?>/admin/" class="d-flex align-items-center text-decoration-none">
                    <img src="<?php echo SITE_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?> Logo" class="me-2">
                    <span class="text-white fw-bold">Admin Panel</span>
                </a>
            </div>
            
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/posts.php" class="nav-link">
                        <i class="fas fa-file-alt"></i> Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/categories.php" class="nav-link">
                        <i class="fas fa-folder"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/resources.php" class="nav-link">
                        <i class="fas fa-link"></i> Resources
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/users.php" class="nav-link">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/subscribers.php" class="nav-link">
                        <i class="fas fa-envelope"></i> Subscribers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/messages.php" class="nav-link">
                        <i class="fas fa-comment-alt"></i> Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/admin/settings.php" class="nav-link">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a href="<?php echo SITE_URL; ?>" class="nav-link">
                        <i class="fas fa-globe"></i> View Website
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/logout.php" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-content">
            <!-- Header -->
            <header class="admin-header d-flex justify-content-between align-items-center">
                <button class="btn btn-outline-secondary toggle-sidebar d-md-none" type="button" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <h1 class="h4 mb-0">Dashboard</h1>
                
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i> <?php echo $currentUser['username']; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/admin/profile.php">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/logout.php">Logout</a></li>
                    </ul>
                </div>
            </header>
            
            <!-- Welcome Alert -->
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Welcome back, <?php echo $currentUser['username']; ?>!</strong> You last logged in on <?php echo formatDate(date('Y-m-d H:i:s', time() - 86400), true); ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            
            <!-- Statistics Cards -->
            <section class="stats-section mb-5">
                <h2 class="h5 mb-4">Website Statistics</h2>
                
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-primary text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['posts']; ?></h3>
                                <p class="stat-title mb-0">Posts</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/posts.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-success text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['categories']; ?></h3>
                                <p class="stat-title mb-0">Categories</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/categories.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-info text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-link"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['resources']; ?></h3>
                                <p class="stat-title mb-0">Resources</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/resources.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-warning text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['subscribers']; ?></h3>
                                <p class="stat-title mb-0">Subscribers</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/subscribers.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-danger text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-comment-alt"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['messages']; ?></h3>
                                <p class="stat-title mb-0">Messages</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/messages.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="card h-100 bg-secondary text-white stat-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 class="stat-number h2 mb-0"><?php echo $stats['users']; ?></h3>
                                <p class="stat-title mb-0">Users</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-center">
                                <a href="<?php echo SITE_URL; ?>/admin/users.php" class="text-white">Manage <i class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Recent Activity Section -->
            <section class="activity-section mb-5">
                <div class="row">
                    <!-- Recent Posts -->
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Posts</h5>
                                <a href="<?php echo SITE_URL; ?>/admin/posts.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($recentPosts)): ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($recentPosts as $post): ?>
                                            <div class="activity-item">
                                                <h6 class="mb-1"><a href="<?php echo SITE_URL; ?>/admin/posts.php?action=edit&id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h6>
                                                <p class="small text-muted mb-0">
                                                    By <?php echo $post['author']; ?> on <?php echo formatDate($post['created_at'], true); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center text-muted my-4">No posts found.</p>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo SITE_URL; ?>/admin/posts.php?action=add" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-plus me-1"></i> Add New Post
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Messages -->
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Messages</h5>
                                <a href="<?php echo SITE_URL; ?>/admin/messages.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($recentMessages)): ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($recentMessages as $message): ?>
                                            <div class="activity-item">
                                                <h6 class="mb-1"><a href="<?php echo SITE_URL; ?>/admin/messages.php?action=view&id=<?php echo $message['id']; ?>"><?php echo $message['subject']; ?></a></h6>
                                                <p class="small text-muted mb-0">
                                                    From <?php echo $message['name']; ?> (<?php echo $message['email']; ?>) on <?php echo formatDate($message['created_at'], true); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center text-muted my-4">No messages found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Subscribers -->
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Subscribers</h5>
                                <a href="<?php echo SITE_URL; ?>/admin/subscribers.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($recentSubscribers)): ?>
                                    <div class="list-group list-group-flush">
                                        <?php foreach ($recentSubscribers as $subscriber): ?>
                                            <div class="activity-item">
                                                <h6 class="mb-1"><?php echo !empty($subscriber['name']) ? $subscriber['name'] : 'Unnamed Subscriber'; ?></h6>
                                                <p class="small text-muted mb-0">
                                                    <?php echo $subscriber['email']; ?> on <?php echo formatDate($subscriber['subscribed_at'], true); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center text-muted my-4">No subscribers found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Quick Actions Section -->
            <section class="quick-actions-section mb-5">
                <h2 class="h5 mb-4">Quick Actions</h2>
                
                <div class="row g-4">
                    <div class="col-md-3">
                        <a href="<?php echo SITE_URL; ?>/admin/posts.php?action=add" class="card h-100 bg-light text-center text-decoration-none">
                            <div class="card-body">
                                <div class="display-4 mb-3 text-primary">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <h3 class="h5">New Post</h3>
                                <p class="text-muted small">Create a new blog post</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="<?php echo SITE_URL; ?>/admin/resources.php?action=add" class="card h-100 bg-light text-center text-decoration-none">
                            <div class="card-body">
                                <div class="display-4 mb-3 text-info">
                                    <i class="fas fa-link"></i>
                                </div>
                                <h3 class="h5">New Resource</h3>
                                <p class="text-muted small">Add a new resource link</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="<?php echo SITE_URL; ?>/admin/users.php?action=add" class="card h-100 bg-light text-center text-decoration-none">
                            <div class="card-body">
                                <div class="display-4 mb-3 text-success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <h3 class="h5">New User</h3>
                                <p class="text-muted small">Add a new administrator</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-3">
                        <a href="<?php echo SITE_URL; ?>/admin/reports.php" class="card h-100 bg-light text-center text-decoration-none">
                            <div class="card-body">
                                <div class="display-4 mb-3 text-secondary">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <h3 class="h5">View Reports</h3>
                                <p class="text-muted small">Check website statistics</p>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('adminSidebar');
            
            if (toggleButton && sidebar) {
                toggleButton.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
                
                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    const isClickInside = sidebar.contains(event.target) || toggleButton.contains(event.target);
                    
                    if (!isClickInside && sidebar.classList.contains('show') && window.innerWidth < 768) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>

