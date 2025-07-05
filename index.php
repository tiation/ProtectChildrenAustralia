<?php
/**
 * Homepage for Protect Children Australia Website
 * 
 * This is the main landing page for the website, featuring:
 * - A welcoming hero section
 * - Safety categories
 * - Recent blog posts
 * - Our approach
 * - Call to action
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Set page-specific variables
$pageTitle = 'Keeping Australian Children Safe';
$pageDescription = 'Resources, information, and support to help protect children from various risks and dangers across Australia.';

// Include header
include_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title slide-in-up">Protecting Australia's Children</h1>
                <p class="hero-subtitle slide-in-up">Providing resources, information, and support to help keep children safe from various risks and dangers in Australia.</p>
                <div class="hero-buttons slide-in-up">
                    <a href="resources.php" class="btn btn-primary btn-lg me-3">Safety Resources</a>
                    <a href="report-concern.php" class="btn btn-danger btn-lg">Report a Concern</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="images/family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif" alt="Happy family outdoors" class="img-fluid hero-image fade-in">
            </div>
        </div>
    </div>
</section>

<!-- Safety Categories Section -->
<section class="categories-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Child Safety Categories</h2>
            <p class="lead">Explore our comprehensive resources on different aspects of child safety</p>
        </div>
        
        <div class="row">
            <!-- Online Safety -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/full-shot-women-cute-girl-park_23-2149363935.jpg" alt="Online Safety">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Online Safety</h3>
                        <p class="category-card-text">Protecting children from online threats including cyberbullying, inappropriate content, and online predators.</p>
                        <a href="category.php?slug=online-safety" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Physical Safety -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/happpy-fam.jpg" alt="Physical Safety">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Physical Safety</h3>
                        <p class="category-card-text">Tips and guidelines for keeping children safe in various environments including water safety, road safety, and stranger danger.</p>
                        <a href="category.php?slug=physical-safety" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Mental Health -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/funny-face.jpg" alt="Mental Health">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Mental Health</h3>
                        <p class="category-card-text">Resources for supporting children's mental wellbeing, preventing bullying, and promoting emotional resilience.</p>
                        <a href="category.php?slug=mental-health" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Emergency Response -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/smiley-women-cute-baby-outdoors.jpg" alt="Emergency Response">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Emergency Response</h3>
                        <p class="category-card-text">Information on how to respond to emergencies involving children, including first aid and emergency contacts.</p>
                        <a href="category.php?slug=emergency-response" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Educational Resources -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif" alt="Educational Resources">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Educational Resources</h3>
                        <p class="category-card-text">Educational materials for parents, teachers, and children about various safety topics.</p>
                        <a href="category.php?slug=educational-resources" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Parenting Tips -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="category-card">
                    <div class="category-card-image">
                        <img src="images/full-shot-women-cute-girl-park_23-2149363935.jpg" alt="Parenting Tips">
                    </div>
                    <div class="category-card-body">
                        <h3 class="category-card-title">Parenting Tips</h3>
                        <p class="category-card-text">Advice and guidance for parents on raising safe and healthy children in Australia.</p>
                        <a href="category.php?slug=parenting-tips" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Emergency CTA -->
<section class="cta-section cta-danger">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="cta-title">Need Immediate Help?</h2>
                <p class="cta-text">If you or a child is in immediate danger, call emergency services at 000 right away.</p>
                <div class="cta-buttons">
                    <a href="emergency.php" class="btn btn-danger btn-lg">Emergency Resources</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Blog Posts -->
<section class="blog-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Latest Safety Articles</h2>
            <p class="lead">Stay informed with our latest articles on child safety topics</p>
        </div>
        
        <div class="row">
            <?php
            // Get recent blog posts (limit to 3)
            $recentPosts = getRecentPosts(3);
            
            if (!empty($recentPosts)) {
                foreach ($recentPosts as $post) {
                    // Format date for display
                    $postDate = formatDate($post['created_at'], true);
                    
                    // Get excerpt from content (first 150 characters)
                    $excerpt = truncateText($post['content'], 150);
                    
                    // Default image if none provided
                    $featuredImage = !empty($post['featured_image']) 
                        ? 'images/' . $post['featured_image'] 
                        : 'images/family-three-spending-time-together-outdoors-father-s-day_23-2150167817.avif';
                    
                    echo <<<HTML
                    <div class="col-md-4 mb-4">
                        <div class="post-card">
                            <div class="post-card-image">
                                <img src="{$featuredImage}" alt="{$post['title']}">
                            </div>
                            <div class="post-card-body">
                                <h3 class="post-card-title">{$post['title']}</h3>
                                <div class="post-card-meta">
                                    <span><i class="fas fa-user"></i> {$post['author']}</span>
                                    <span><i class="fas fa-calendar"></i> {$postDate}</span>
                                    <span><i class="fas fa-folder"></i> {$post['category_name']}</span>
                                </div>
                                <p class="post-card-excerpt">{$excerpt}</p>
                                <a href="blog-post.php?id={$post['id']}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                    HTML;
                }
            } else {
                // Display placeholder posts if no posts exist yet
                ?>
                <div class="col-md-4 mb-4">
                    <div class="post-card">
                        <div class="post-card-image">
                            <img src="images/full-shot-women-cute-girl-park_23-2149363935.jpg" alt="Online Safety Tips">
                        </div>
                        <div class="post-card-body">
                            <h3 class="post-card-title">Essential Online Safety Tips for Parents</h3>
                            <div class="post-card-meta">
                                <span><i class="fas fa-user"></i> Admin</span>
                                <span><i class="fas fa-calendar"></i> 01/06/2025</span>
                                <span><i class="fas fa-folder"></i> Online Safety</span>
                            </div>
                            <p class="post-card-excerpt">Learn how to keep your children safe online with these essential tips covering social media, gaming, and more...</p>
                            <a href="blog.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="post-card">
                        <div class="post-card-image">
                            <img src="images/happpy-fam.jpg" alt="Water Safety">
                        </div>
                        <div class="post-card-body">
                            <h3 class="post-card-title">Summer Water Safety Guide</h3>
                            <div class="post-card-meta">
                                <span><i class="fas fa-user"></i> Admin</span>
                                <span><i class="fas fa-calendar"></i> 30/05/2025</span>
                                <span><i class="fas fa-folder"></i> Physical Safety</span>
                            </div>
                            <p class="post-card-excerpt">As summer approaches, ensure your family stays safe around water with these crucial safety guidelines for beaches, pools, and rivers...</p>
                            <a href="blog.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="post-card">
                        <div class="post-card-image">
                            <img src="images/funny-face.jpg" alt="Bullying Prevention">
                        </div>
                        <div class="post-card-body">
                            <h3 class="post-card-title">Helping Children Deal with Bullying</h3>
                            <div class="post-card-meta">
                                <span><i class="fas fa-user"></i> Admin</span>
                                <span><i class="fas fa-calendar"></i> 25/05/2025</span>
                                <span><i class="fas fa-folder"></i> Mental Health</span>
                            </div>
                            <p class="post-card-excerpt">Strategies for parents and educators to identify signs of bullying and help children develop resilience and coping mechanisms...</p>
                            <a href="blog.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="blog.php" class="btn btn-outline-primary btn-lg">View All Articles</a>
        </div>
    </div>
</section>

<!-- Our Approach Section -->
<section class="approach-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="images/smiley-women-cute-baby-outdoors.jpg" alt="Our Approach" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <div class="approach-content">
                    <h2>Our Approach to Child Safety</h2>
                    <p class="lead">We believe that every child deserves to grow up in a safe and nurturing environment.</p>
                    
                    <div class="approach-item d-flex mb-4">
                        <div class="approach-icon me-3">
                            <i class="fas fa-shield-alt text-primary fa-2x"></i>
                        </div>
                        <div class="approach-text">
                            <h4>Prevention First</h4>
                            <p>We focus on preventative measures and education to stop issues before they arise, empowering families with knowledge and tools.</p>
                        </div>
                    </div>
                    
                    <div class="approach-item d-flex mb-4">
                        <div class="approach-icon me-3">
                            <i class="fas fa-book-open text-primary fa-2x"></i>
                        </div>
                        <div class="approach-text">
                            <h4>Evidence-Based Resources</h4>
                            <p>Our resources and recommendations are based on the latest research and expert advice in child safety and wellbeing.</p>
                        </div>
                    </div>
                    
                    <div class="approach-item d-flex mb-4">
                        <div class="approach-icon me-3">
                            <i class="fas fa-users text-primary fa-2x"></i>
                        </div>
                        <div class="approach-text">
                            <h4>Community Support</h4>
                            <p>We believe in building a supportive community where parents, educators, and caregivers can share experiences and strategies.</p>
                        </div>
                    </div>
                    
                    <div class="approach-item d-flex">
                        <div class="approach-icon me-3">
                            <i class="fas fa-heart text-primary fa-2x"></i>
                        </div>
                        <div class="approach-text">
                            <h4>Child-Centered</h4>
                            <p>Children's needs, rights, and wellbeing are at the center of everything we do, with a focus on nurturing their development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section cta-accent">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="cta-title">Join Our Community of Child Safety Advocates</h2>
                <p class="cta-text">Subscribe to our newsletter for regular updates, safety tips, and resources to help keep Australian children safe.</p>
                <form action="newsletter-subscribe.php" method="post" class="cta-form row g-3 justify-content-center">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-5">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Resources Quick Links -->
<section class="resources-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>Essential Safety Resources</h2>
            <p class="lead">Quick access to important safety resources and hotlines</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4 text-center">
                                <div class="resource-quick-link">
                                    <div class="resource-icon mb-3">
                                        <i class="fas fa-phone-alt text-danger fa-3x"></i>
                                    </div>
                                    <h4>Emergency Services</h4>
                                    <p>For immediate danger or emergency situations</p>
                                    <p class="resource-highlight">000</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="resource-quick-link">
                                    <div class="resource-icon mb-3">
                                        <i class="fas fa-comments text-primary fa-3x"></i>
                                    </div>
                                    <h4>Kids Helpline</h4>
                                    <p>Counselling service for young people aged 5 to 25</p>
                                    <p class="resource-highlight">1800 55 1800</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="resource-quick-link">
                                    <div class="resource-icon mb-3">
                                        <i class="fas fa-hands-helping text-success fa-3x"></i>
                                    </div>
                                    <h4>Parentline</h4>
                                    <p>Support and counselling for parents and carers</p>
                                    <p class="resource-highlight">1300 30 1300</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <a href="emergency.php" class="btn btn-outline-primary">View All Emergency Resources</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once 'includes/footer.php';
?>

