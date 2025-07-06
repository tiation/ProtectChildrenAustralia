<?php
/**
 * Blog Post: Parental Post‑Traumatic Growth: From Loss to Leadership 🌱🏅
 * Generated from: 100_posttraumatic_growth.html
 * Category: mental-health
 */

// Define base path constant (required by include files)
define('BASEPATH', true);

// Include required files
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Set page-specific variables
$pageTitle = 'Parental Post‑Traumatic Growth: From Loss to Leadership 🌱🏅';
$pageDescription = 'Parental Post‑Traumatic Growth: From Loss to Leadership 🌱🏅 ### LONG FORM Post‑Traumatic Growth (PTG) theory (Tedeschi &amp; Calhoun) describes positiv';
$postSlug = 'posttraumatic-growth';
$postCategory = 'mental-health';

// Additional meta tags and styles for blog posts
$extraStyles = '
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="article">
    <meta property="article:section" content="' . $postCategory . '">
    <link rel="canonical" href="' . SITE_URL . '/posts/' . $postSlug . '.php">
    <style>
        .blog-post-content {
            font-size: 1.1rem;
            line-height: 1.7;
        }
        .blog-post-content h1,
        .blog-post-content h2,
        .blog-post-content h3 {
            color: #2c5aa0;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .blog-post-content p {
            margin-bottom: 1.5rem;
        }
        .blog-post-content ul,
        .blog-post-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }
        .blog-post-content blockquote {
            border-left: 4px solid #2c5aa0;
            padding-left: 1rem;
            margin: 2rem 0;
            font-style: italic;
            background-color: #f8f9fa;
            padding: 1rem;
        }
        .post-navigation {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
';

// Include header
include_once '../includes/header.php';
?>

<!-- Blog Post Content -->
<article class="blog-post py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/blog.php">Blog</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/blog.php?category=<?php echo $postCategory; ?>">Mental Health</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle; ?></li>
                    </ol>
                </nav>

                <!-- Post Header -->
                <header class="post-header mb-4">
                    <div class="post-meta text-muted mb-2">
                        <span><i class="fas fa-folder me-1"></i> <a href="<?php echo SITE_URL; ?>/blog.php?category=<?php echo $postCategory; ?>"><?php echo ucwords(str_replace('-', ' ', $postCategory)); ?></a></span>
                        <span class="mx-2">|</span>
                        <span><i class="fas fa-clock me-1"></i> July 5, 2025</span>
                    </div>
                </header>

                <!-- Post Content -->
                <div class="blog-post-content">
<h1>Parental Post‑Traumatic Growth: From Loss to Leadership 🌱🏅</h1>
<p>### LONG FORM</p>
<p>Post‑Traumatic Growth (PTG) theory (Tedeschi &amp; Calhoun) describes positive change after crisis in five domains.</p>
<p>## 1 Appreciation of Life  <br>Morning bird song feels louder; gratitude journal captures specifics.</p>
<p>## 2 Relating to Others  <br>Joined bereaved‑parent forum, now mentor newcomers—mutual healing.</p>
<p>## 3 New Possibilities  <br>Pursued certification as swim‑safety instructor; side career blooms.</p>
<p>## 4 Personal Strength  <br>If I survived *that*, difficult conversations with officials seem minor.</p>
<p>## 5 Spiritual Change  <br>Not religious, but I practice “acts of service” meditation by volunteering at river clean‑ups.</p>
<p>&gt; PTG doesn’t cancel grief; it layers meaning atop it, like kintsugi filling cracks with gold.  <br>Leadership grows in the fissures loss leaves behind.</p>
                </div>

                <!-- Post Navigation -->
                <div class="post-navigation">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo SITE_URL; ?>/blog.php" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Blog
                            </a>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <a href="<?php echo SITE_URL; ?>/blog.php?category=<?php echo $postCategory; ?>" class="btn btn-outline-secondary">
                                More <?php echo ucwords(str_replace('-', ' ', $postCategory)); ?> Articles<i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Articles CTA -->
<section class="cta-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2>Looking for More Child Safety Resources?</h2>
                <p class="lead">Explore our comprehensive collection of articles and resources designed to keep children safe.</p>
                <div class="mt-4">
                    <a href="<?php echo SITE_URL; ?>/blog.php" class="btn btn-primary btn-lg me-3">View All Articles</a>
                    <a href="<?php echo SITE_URL; ?>/resources.php" class="btn btn-outline-primary btn-lg">Safety Resources</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once '../includes/footer.php';
?>
