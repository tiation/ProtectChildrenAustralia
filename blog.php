<?php
/**
 * Blog Page for Protect Children Australia Website
 * 
 * This page displays blog posts with:
 * - Pagination
 * - Category filtering
 * - Search functionality
 * - Sidebar with categories and recent posts
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Set page-specific variables
$pageTitle = 'Blog - Child Safety Articles';
$pageDescription = 'Read our latest articles and insights on child safety topics, from online safety to mental health, physical wellbeing to emergency response.';

// Initialize variables
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 6;
$offset = ($currentPage - 1) * $postsPerPage;
$categoryFilter = isset($_GET['category']) ? sanitizeInput($_GET['category']) : '';
$searchQuery = isset($_GET['q']) ? sanitizeInput($_GET['q']) : '';
$categoryInfo = null;
$totalPosts = 0;

// Build SQL query based on filters
$sql = "SELECT p.id, p.title, p.content, p.featured_image, p.created_at, 
               c.name as category_name, c.slug as category_slug,
               u.username as author
        FROM posts p
        JOIN categories c ON p.category_id = c.id
        JOIN users u ON p.author_id = u.id";

$countSql = "SELECT COUNT(*) as total FROM posts p";

$params = [];
$whereConditions = [];

// Add category filter if set
if (!empty($categoryFilter)) {
    $countSql .= " JOIN categories c ON p.category_id = c.id";
    $whereConditions[] = "c.slug = ?";
    $params[] = $categoryFilter;
    
    // Get category info for title and description
    $categoryInfo = getCategoryBySlug($categoryFilter);
    if ($categoryInfo) {
        $pageTitle = $categoryInfo['name'] . ' - Blog Articles';
        $pageDescription = 'Articles related to ' . $categoryInfo['name'] . ': ' . $categoryInfo['description'];
    }
}

// Add search filter if set
if (!empty($searchQuery)) {
    if (empty($categoryFilter)) {
        $countSql .= " JOIN categories c ON p.category_id = c.id";
    }
    $whereConditions[] = "(p.title LIKE ? OR p.content LIKE ?)";
    $params[] = "%{$searchQuery}%";
    $params[] = "%{$searchQuery}%";
    
    $pageTitle = 'Search Results: ' . $searchQuery;
    $pageDescription = 'Blog articles matching your search for "' . $searchQuery . '"';
}

// Add WHERE clause if needed
if (!empty($whereConditions)) {
    $whereClause = " WHERE " . implode(' AND ', $whereConditions);
    $sql .= $whereClause;
    $countSql .= $whereClause;
}

// Add sorting and pagination
$sql .= " ORDER BY p.created_at DESC LIMIT ? OFFSET ?";
$params[] = $postsPerPage;
$params[] = $offset;

// Get total post count for pagination
$countResult = fetchSingle($countSql, $params);
$totalPosts = $countResult ? $countResult['total'] : 0;
$totalPages = ceil($totalPosts / $postsPerPage);

// Get posts
$posts = fetchAll($sql, $params);

// Get all categories for sidebar
$categories = getAllCategories();

// Get recent posts for sidebar (5 most recent)
$recentPosts = getRecentPosts(5);

// Include header
include_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="page-header bg-primary-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1><?php echo $pageTitle; ?></h1>
                <p class="lead"><?php echo $pageDescription; ?></p>
                
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>">Home</a></li>
                        <li class="breadcrumb-item<?php echo empty($categoryFilter) && empty($searchQuery) ? ' active' : ''; ?>">
                            <?php if (!empty($categoryFilter) || !empty($searchQuery)): ?>
                                <a href="blog.php">Blog</a>
                            <?php else: ?>
                                Blog
                            <?php endif; ?>
                        </li>
                        <?php if (!empty($categoryFilter) && $categoryInfo): ?>
                            <li class="breadcrumb-item active"><?php echo $categoryInfo['name']; ?></li>
                        <?php elseif (!empty($searchQuery)): ?>
                            <li class="breadcrumb-item active">Search: <?php echo $searchQuery; ?></li>
                        <?php endif; ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="blog-content py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Search Form (Mobile Only) -->
                <div class="d-block d-md-none mb-4">
                    <form action="blog.php" method="get" class="search-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search articles..." value="<?php echo $searchQuery; ?>">
                            <?php if (!empty($categoryFilter)): ?>
                                <input type="hidden" name="category" value="<?php echo $categoryFilter; ?>">
                            <?php endif; ?>
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                
                <?php if (!empty($posts)): ?>
                    <div class="row">
                        <?php foreach ($posts as $post): 
                            // Format date for display
                            $postDate = formatDate($post['created_at'], true);
                            
                            // Get excerpt from content
                            $excerpt = truncateText($post['content'], 150);
                            
                            // Default image if none provided
                            $featuredImage = !empty($post['featured_image']) 
                                ? 'images/' . $post['featured_image'] 
                                : 'images/family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif';
                        ?>
                        <div class="col-md-6 mb-4">
                            <div class="post-card h-100">
                                <div class="post-card-image">
                                    <img src="<?php echo $featuredImage; ?>" alt="<?php echo $post['title']; ?>" class="img-fluid">
                                </div>
                                <div class="post-card-body">
                                    <h2 class="post-card-title h4"><?php echo $post['title']; ?></h2>
                                    <div class="post-card-meta text-muted mb-2">
                                        <span><i class="fas fa-user me-1"></i> <?php echo $post['author']; ?></span>
                                        <span class="mx-2">|</span>
                                        <span><i class="fas fa-calendar me-1"></i> <?php echo $postDate; ?></span>
                                        <span class="mx-2">|</span>
                                        <span><i class="fas fa-folder me-1"></i> <a href="blog.php?category=<?php echo $post['category_slug']; ?>"><?php echo $post['category_name']; ?></a></span>
                                    </div>
                                    <p class="post-card-excerpt"><?php echo $excerpt; ?></p>
                                    <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <?php
                            // Previous page link
                            if ($currentPage > 1):
                                $prevLink = "blog.php?page=" . ($currentPage - 1);
                                if (!empty($categoryFilter)) $prevLink .= "&category=" . $categoryFilter;
                                if (!empty($searchQuery)) $prevLink .= "&q=" . urlencode($searchQuery);
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $prevLink; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            
                            <?php
                            // Page number links
                            for ($i = 1; $i <= $totalPages; $i++):
                                $isActive = $i == $currentPage;
                                $pageLink = "blog.php?page=" . $i;
                                if (!empty($categoryFilter)) $pageLink .= "&category=" . $categoryFilter;
                                if (!empty($searchQuery)) $pageLink .= "&q=" . urlencode($searchQuery);
                            ?>
                            <li class="page-item<?php echo $isActive ? ' active' : ''; ?>">
                                <a class="page-link" href="<?php echo $pageLink; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endfor; ?>
                            
                            <?php
                            // Next page link
                            if ($currentPage < $totalPages):
                                $nextLink = "blog.php?page=" . ($currentPage + 1);
                                if (!empty($categoryFilter)) $nextLink .= "&category=" . $categoryFilter;
                                if (!empty($searchQuery)) $nextLink .= "&q=" . urlencode($searchQuery);
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $nextLink; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <?php endif; ?>
                    
                <?php else: ?>
                    <!-- No Posts Found State -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-search fa-4x text-muted"></i>
                        </div>
                        <?php if (!empty($searchQuery)): ?>
                            <h2>No Results Found</h2>
                            <p class="lead">We couldn't find any posts matching "<?php echo $searchQuery; ?>".</p>
                            <div class="mt-4">
                                <a href="blog.php" class="btn btn-primary">View All Articles</a>
                            </div>
                        <?php elseif (!empty($categoryFilter)): ?>
                            <h2>No Articles Found</h2>
                            <p class="lead">We don't have any articles in this category yet. Please check back soon!</p>
                            <div class="mt-4">
                                <a href="blog.php" class="btn btn-primary">View All Articles</a>
                            </div>
                        <?php else: ?>
                            <h2>Coming Soon!</h2>
                            <p class="lead">We're working on creating valuable content for you. Please check back soon!</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Search Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 card-title">Search Articles</h3>
                        <form action="blog.php" method="get" class="search-form">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search articles..." value="<?php echo $searchQuery; ?>">
                                <?php if (!empty($categoryFilter)): ?>
                                    <input type="hidden" name="category" value="<?php echo $categoryFilter; ?>">
                                <?php endif; ?>
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 card-title">Categories</h3>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($categories as $cat): 
                                $isActive = $categoryFilter === $cat['slug'];
                            ?>
                            <li class="list-group-item<?php echo $isActive ? ' active' : ''; ?>">
                                <a href="blog.php?category=<?php echo $cat['slug']; ?>" class="d-flex justify-content-between align-items-center<?php echo $isActive ? ' text-white' : ''; ?>">
                                    <?php echo $cat['name']; ?>
                                    <?php
                                    // You could add post count per category here if available
                                    // echo '<span class="badge bg-primary rounded-pill">14</span>';
                                    ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Recent Posts -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 card-title">Recent Articles</h3>
                        <ul class="list-unstyled">
                            <?php foreach ($recentPosts as $recent): 
                                $recentDate = formatDate($recent['created_at']);
                            ?>
                            <li class="mb-3 pb-3 border-bottom">
                                <h4 class="h6 mb-1">
                                    <a href="blog-post.php?id=<?php echo $recent['id']; ?>"><?php echo $recent['title']; ?></a>
                                </h4>
                                <div class="small text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i> <?php echo $recentDate; ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Newsletter Signup -->
                <div class="card shadow-sm bg-primary text-white">
                    <div class="card-body p-4">
                        <h3 class="h5 card-title">Subscribe to Our Newsletter</h3>
                        <p>Stay updated with the latest child safety information, resources, and tips.</p>
                        <form action="newsletter-subscribe.php" method="post">
                            <input type="hidden" name="_token" value="<?php echo session_id(); ?>">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <button type="submit" class="btn btn-light w-100">Subscribe</button>
                        </form>
                    </div>
                </div>
                
                <!-- Help CTA -->
                <div class="card shadow-sm bg-secondary-light mt-4">
                    <div class="card-body p-4 text-center">
                        <h3 class="h5 card-title">Need Help?</h3>
                        <p>If you have questions or concerns about child safety, our team is here to help.</p>
                        <a href="contact.php" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section cta-accent">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="cta-title">Share Your Knowledge</h2>
                <p class="cta-text">Are you an expert in child safety? Consider contributing an article to our blog to help other parents and caregivers.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary btn-lg">Contact Us to Contribute</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once 'includes/footer.php';
?>

