<?php
/**
 * Category Page for Protect Children Australia Website
 * 
 * This page displays content for a specific safety category, including:
 * - Category details (title, description)
 * - Related resources
 * - Related blog posts
 * - Calls to action
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Get category slug from URL parameter
$categorySlug = isset($_GET['slug']) ? sanitizeInput($_GET['slug']) : '';

// If no slug provided, redirect to homepage
if (empty($categorySlug)) {
    redirect(SITE_URL);
}

// Fetch category details
$category = getCategoryBySlug($categorySlug);

// If category not found, redirect to homepage with error message
if (!$category) {
    $_SESSION['error_message'] = 'Category not found. Please select a valid category.';
    redirect(SITE_URL);
}

// Set page-specific variables
$pageTitle = $category['name'];
$pageDescription = $category['description'];

// Get resources for this category
$resources = getResourcesByCategory($category['id'], 10);

// Get related blog posts for this category
$sql = "SELECT p.id, p.title, p.content, p.featured_image, p.created_at, 
               u.username as author
        FROM posts p
        JOIN users u ON p.author_id = u.id
        WHERE p.category_id = ?
        ORDER BY p.created_at DESC
        LIMIT 4";
$posts = fetchAll($sql, [$category['id']]);

// Choose appropriate image for category based on slug
$categoryImages = [
    'online-safety' => 'full-shot-women-cute-girl-park_23-2149363935.jpg',
    'physical-safety' => 'happpy-fam.jpg',
    'mental-health' => 'funny-face.jpg',
    'emergency-response' => 'smiley-women-cute-baby-outdoors.jpg',
    'educational-resources' => 'family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif',
    'parenting-tips' => 'family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif',
    'school-safety' => 'full-shot-women-cute-girl-park_23-2149363935.jpg',
    'legal-information' => 'happpy-fam.jpg'
];

$categoryImage = isset($categoryImages[$categorySlug]) 
    ? $categoryImages[$categorySlug] 
    : 'family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif';

// Include header
include_once 'includes/header.php';
?>

<!-- Category Hero Section -->
<section class="page-header bg-primary-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="mb-3"><?php echo $category['name']; ?></h1>
                <p class="lead"><?php echo $category['description']; ?></p>
                
                <!-- Action Buttons -->
                <div class="mt-4">
                    <a href="#resources" class="btn btn-primary me-3">View Resources</a>
                    <a href="#related-posts" class="btn btn-outline-primary">Read Articles</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="images/<?php echo $categoryImage; ?>" alt="<?php echo $category['name']; ?>" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php
                // Display category-specific introduction based on slug
                switch ($categorySlug) {
                    case 'online-safety':
                        echo '<h2>Protecting Children in the Digital World</h2>
                              <p>The internet offers incredible opportunities for learning and connection, but it also presents unique risks for children. This section provides resources to help parents, educators, and caregivers ensure children can benefit from technology while staying safe online.</p>
                              <p>From cyberbullying to inappropriate content, online predators to privacy concerns, we cover the essential information you need to protect children in the digital environment.</p>';
                        break;
                    
                    case 'physical-safety':
                        echo '<h2>Ensuring Children\'s Physical Wellbeing</h2>
                              <p>Protecting children from physical harm is a fundamental responsibility. This section covers various aspects of physical safety including water safety, road safety, home safety, and recognizing and responding to potential dangers.</p>
                              <p>Our resources help you create safer environments for children and teach them age-appropriate safety skills to protect themselves.</p>';
                        break;
                    
                    case 'mental-health':
                        echo '<h2>Supporting Children\'s Mental Wellbeing</h2>
                              <p>Mental health is just as important as physical health for children\'s overall wellbeing. This section provides resources on supporting emotional development, recognizing signs of distress, preventing bullying, and promoting resilience.</p>
                              <p>Learn how to foster positive mental health and help children develop the emotional skills they need to thrive.</p>';
                        break;
                    
                    case 'emergency-response':
                        echo '<h2>Responding to Emergency Situations</h2>
                              <p>Being prepared for emergencies is crucial when caring for children. This section covers essential information about first aid, emergency contacts, and how to respond effectively in crisis situations involving children.</p>
                              <p>Our resources help you develop emergency plans, recognize when immediate action is needed, and know exactly what steps to take to ensure children\'s safety.</p>';
                        break;
                    
                    default:
                        echo '<h2>Comprehensive Resources for ' . $category['name'] . '</h2>
                              <p>This section provides information, tools, and guidance related to ' . strtolower($category['name']) . ' for children in Australia. Browse our curated resources and articles to learn more about keeping children safe in this important area.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Resources Section -->
<section id="resources" class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2><?php echo $category['name']; ?> Resources</h2>
            <p class="lead">Helpful information and tools for parents, educators, and caregivers</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body p-0">
                        <?php if (!empty($resources)): ?>
                            <ul class="resource-list">
                                <?php foreach ($resources as $resource): ?>
                                <li class="resource-item">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h3 class="resource-title"><?php echo $resource['title']; ?></h3>
                                            <p class="mb-2"><?php echo $resource['description']; ?></p>
                                            <p class="small text-muted">Added: <?php echo formatDate($resource['created_at']); ?></p>
                                        </div>
                                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                            <a href="<?php echo $resource['link']; ?>" class="btn btn-primary resource-link" target="_blank">
                                                <i class="fas fa-external-link-alt me-2"></i> View Resource
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="p-5 text-center">
                                <p>No resources found for this category yet. Please check back soon as we continue to add valuable information.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Additional Resources CTA -->
                <div class="text-center mt-4">
                    <a href="resources.php" class="btn btn-outline-primary">View All Resources</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Safety Tips Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Essential <?php echo $category['name']; ?> Tips</h2>
            <p class="lead">Quick guidelines to help keep children safe</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-4">
                    <?php
                    // Display category-specific tips based on slug
                    $tips = [];
                    
                    switch ($categorySlug) {
                        case 'online-safety':
                            $tips = [
                                ['title' => 'Set Clear Boundaries', 'icon' => 'fa-shield-alt', 'text' => 'Establish clear rules about screen time, appropriate websites, and online behavior.'],
                                ['title' => 'Use Parental Controls', 'icon' => 'fa-lock', 'text' => 'Set up age-appropriate filters, privacy settings, and monitoring tools on devices and platforms.'],
                                ['title' => 'Stay Involved', 'icon' => 'fa-users', 'text' => 'Regularly talk with children about their online activities and be alert to signs of cyberbullying or other issues.'],
                                ['title' => 'Teach Privacy Basics', 'icon' => 'fa-user-secret', 'text' => 'Help children understand what personal information should never be shared online.'],
                            ];
                            break;
                        
                        case 'physical-safety':
                            $tips = [
                                ['title' => 'Water Safety First', 'icon' => 'fa-swimming-pool', 'text' => 'Never leave children unattended near water, enroll them in swimming lessons, and secure pool areas.'],
                                ['title' => 'Road Safety Rules', 'icon' => 'fa-car', 'text' => 'Teach children to use pedestrian crossings, wear helmets while cycling, and understand basic road rules.'],
                                ['title' => 'Secure Your Home', 'icon' => 'fa-home', 'text' => 'Child-proof your home by securing furniture, storing dangerous items out of reach, and installing safety gates.'],
                                ['title' => 'Stranger Awareness', 'icon' => 'fa-exclamation-triangle', 'text' => 'Teach children about appropriate interactions with unfamiliar adults and what to do if approached.'],
                            ];
                            break;
                        
                        case 'mental-health':
                            $tips = [
                                ['title' => 'Open Communication', 'icon' => 'fa-comments', 'text' => 'Create a safe space for children to express their feelings and concerns without judgment.'],
                                ['title' => 'Recognize Warning Signs', 'icon' => 'fa-exclamation-circle', 'text' => 'Be alert to changes in behavior, sleep patterns, or social interactions that may indicate distress.'],
                                ['title' => 'Promote Self-Care', 'icon' => 'fa-heart', 'text' => 'Encourage healthy habits including physical activity, proper sleep, and time for relaxation and play.'],
                                ['title' => 'Seek Professional Help', 'icon' => 'fa-user-md', 'text' => 'Don\'t hesitate to consult with mental health professionals if you have concerns about a child\'s wellbeing.'],
                            ];
                            break;
                        
                        case 'emergency-response':
                            $tips = [
                                ['title' => 'Know Emergency Numbers', 'icon' => 'fa-phone', 'text' => 'Ensure children know when and how to call 000 for emergencies and other important contact numbers.'],
                                ['title' => 'Create Safety Plans', 'icon' => 'fa-clipboard-list', 'text' => 'Develop and practice emergency plans for different scenarios (fire, medical emergency, etc.).'],
                                ['title' => 'Learn Basic First Aid', 'icon' => 'fa-medkit', 'text' => 'Adults responsible for children should have basic first aid knowledge and keep supplies accessible.'],
                                ['title' => 'Stay Calm and Clear', 'icon' => 'fa-heart-rate', 'text' => 'In emergencies, stay calm and give clear, simple instructions to children about what to do.'],
                            ];
                            break;
                        
                        default:
                            $tips = [
                                ['title' => 'Stay Informed', 'icon' => 'fa-book', 'text' => 'Keep up with the latest research and recommendations on child safety in this area.'],
                                ['title' => 'Communicate Openly', 'icon' => 'fa-comments', 'text' => 'Maintain open, age-appropriate conversations with children about safety concerns.'],
                                ['title' => 'Be a Role Model', 'icon' => 'fa-user', 'text' => 'Demonstrate safe and responsible behavior in your own actions and decisions.'],
                                ['title' => 'Seek Support', 'icon' => 'fa-hands-helping', 'text' => 'Don\'t hesitate to reach out for professional advice or assistance when needed.'],
                            ];
                    }
                    
                    foreach ($tips as $tip):
                    ?>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="fa-stack fa-2x">
                                            <i class="fas fa-circle fa-stack-2x text-primary-light"></i>
                                            <i class="fas <?php echo $tip['icon']; ?> fa-stack-1x text-primary"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <h3 class="h5"><?php echo $tip['title']; ?></h3>
                                        <p class="mb-0"><?php echo $tip['text']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Blog Posts Section -->
<section id="related-posts" class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Related Articles</h2>
            <p class="lead">Learn more about <?php echo strtolower($category['name']); ?> through our informative articles</p>
        </div>
        
        <div class="row">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): 
                    // Format date for display
                    $postDate = formatDate($post['created_at'], true);
                    
                    // Get excerpt from content (first 150 characters)
                    $excerpt = truncateText($post['content'], 150);
                    
                    // Default image if none provided
                    $featuredImage = !empty($post['featured_image']) 
                        ? 'images/' . $post['featured_image'] 
                        : 'images/' . $categoryImage;
                ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="post-card h-100">
                        <div class="post-card-image">
                            <img src="<?php echo $featuredImage; ?>" alt="<?php echo $post['title']; ?>">
                        </div>
                        <div class="post-card-body">
                            <h3 class="post-card-title h5"><?php echo $post['title']; ?></h3>
                            <div class="post-card-meta small text-muted mb-2">
                                <span><i class="fas fa-user me-1"></i> <?php echo $post['author']; ?></span>
                                <span class="ms-2"><i class="fas fa-calendar me-1"></i> <?php echo $postDate; ?></span>
                            </div>
                            <p class="post-card-excerpt small"><?php echo $excerpt; ?></p>
                            <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No articles found for this category yet. Please check back soon for updates.</p>
                    <a href="blog.php" class="btn btn-outline-primary mt-3">Browse All Articles</a>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($posts)): ?>
        <div class="text-center mt-4">
            <a href="blog.php?category=<?php echo $category['slug']; ?>" class="btn btn-outline-primary">View All <?php echo $category['name']; ?> Articles</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Expert Help CTA -->
<section class="cta-section cta-accent">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="cta-title">Need Expert Guidance?</h2>
                <p class="cta-text">Our team is available to provide personalized advice and support for <?php echo strtolower($category['name']); ?> concerns.</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn btn-primary btn-lg me-3">Contact Us</a>
                    <a href="resources.php" class="btn btn-outline-light btn-lg">Explore Resources</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2>Stay Updated on <?php echo $category['name']; ?></h2>
                <p class="lead mb-4">Subscribe to our newsletter for the latest safety information, resources, and tips.</p>
                
                <form action="newsletter-subscribe.php" method="post" class="row g-3 justify-content-center">
                    <input type="hidden" name="_token" value="<?php echo session_id(); ?>">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-5">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once 'includes/footer.php';
?>

