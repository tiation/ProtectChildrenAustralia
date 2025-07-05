<?php
/**
 * Footer template for all pages
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>

        </div><!-- /.container from header -->
    </main>

    <!-- Newsletter Signup Section -->
    <section class="newsletter-section py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h3>Stay Informed About Child Safety</h3>
                    <p>Subscribe to our newsletter for regular updates, safety tips, and resources.</p>
                    <form action="<?php echo SITE_URL; ?>/newsletter-subscribe.php" method="post" class="row g-3 justify-content-center">
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

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top py-4 bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h4>About Us</h4>
                        <p>Protect Children Australia is dedicated to providing resources and information to help keep children safe from various risks and dangers in Australia.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled footer-links">
                            <li><a href="<?php echo SITE_URL; ?>" class="text-white">Home</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/category.php?slug=online-safety" class="text-white">Online Safety</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/category.php?slug=physical-safety" class="text-white">Physical Safety</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/category.php?slug=mental-health" class="text-white">Mental Health</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/blog.php" class="text-white">Blog</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/resources.php" class="text-white">Resources</a></li>
                            <li><a href="<?php echo SITE_URL; ?>/contact.php" class="text-white">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h4>Emergency Contacts</h4>
                        <ul class="list-unstyled emergency-contacts">
                            <li><strong>Emergency Services:</strong> <?php echo EMERGENCY_POLICE; ?></li>
                            <li><strong>Kids Helpline:</strong> <?php echo KIDS_HELPLINE; ?></li>
                            <li><strong>Lifeline:</strong> <?php echo LIFELINE; ?></li>
                            <li><strong>Parentline:</strong> <?php echo PARENTLINE; ?></li>
                        </ul>
                        <p class="mt-3">
                            <a href="<?php echo SITE_URL; ?>/emergency-resources.php" class="btn btn-outline-light">View All Emergency Resources</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3 bg-dark text-white">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="<?php echo SITE_URL; ?>/privacy-policy.php" class="text-white">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="<?php echo SITE_URL; ?>/terms-of-use.php" class="text-white">Terms of Use</a></li>
                            <li class="list-inline-item"><a href="<?php echo SITE_URL; ?>/sitemap.php" class="text-white">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for some custom functionality) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="<?php echo SITE_URL; ?>/js/scripts.js"></script>
    
    <?php if (isset($extraScripts)): ?>
        <?php echo $extraScripts; ?>
    <?php endif; ?>
</body>
</html>

