#!/usr/bin/env python3
"""
Script to add consistent navigation to all blog posts.
This adds header navigation, back links, and next/previous navigation.
"""

import os
import re
from pathlib import Path

def get_post_info(filename):
    """Extract post number and title from filename and content."""
    match = re.match(r'(\d+)_(.+)\.html$', filename)
    if match:
        number = int(match.group(1))
        slug = match.group(2)
        return number, slug
    return None, None

def create_navigation_header():
    """Create the standard navigation header for blog posts."""
    return '''
    <!-- Navigation Header -->
    <nav class="blog-nav py-3 border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="../index.html" class="btn btn-outline-primary btn-sm me-2">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="../blog.html" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-newspaper"></i> All Articles
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <img src="../images/logo.png" alt="Protect Children Australia" style="max-height: 30px;" class="me-2">
                    <span class="fw-bold text-primary">Protect Children Australia</span>
                </div>
            </div>
        </div>
    </nav>
'''

def create_post_navigation(current_post, all_posts):
    """Create previous/next navigation for blog posts."""
    prev_link = ""
    next_link = ""
    
    current_index = None
    for i, (post_num, filename) in enumerate(all_posts):
        if post_num == current_post:
            current_index = i
            break
    
    if current_index is not None:
        if current_index > 0:
            prev_filename = all_posts[current_index - 1][1]
            prev_link = f'<a href="{prev_filename}" class="btn btn-outline-primary"><i class="fas fa-chevron-left"></i> Previous Post</a>'
        
        if current_index < len(all_posts) - 1:
            next_filename = all_posts[current_index + 1][1]
            next_link = f'<a href="{next_filename}" class="btn btn-outline-primary">Next Post <i class="fas fa-chevron-right"></i></a>'
    
    return f'''
    <!-- Post Navigation -->
    <nav class="post-navigation py-4 border-top mt-4">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    {prev_link}
                </div>
                <div class="col-6 text-end">
                    {next_link}
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="../blog.html" class="btn btn-primary">
                    <i class="fas fa-th-large"></i> Browse All Articles
                </a>
            </div>
        </div>
    </nav>
'''

def create_footer():
    """Create consistent footer for blog posts."""
    return '''
    <!-- Footer -->
    <footer class="site-footer bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Protect Children Australia</h5>
                    <p class="mb-2">Comprehensive child safety resources for Australian families.</p>
                    <p class="mb-0">&copy; 2025 Protect Children Australia. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <h6>Important Contacts</h6>
                    <ul class="list-unstyled small">
                        <li><strong>Emergency:</strong> 000</li>
                        <li><strong>Kids Helpline:</strong> 1800 55 1800</li>
                        <li><strong>Lifeline:</strong> 13 11 14</li>
                        <li><strong>Parentline:</strong> 1300 30 1300</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
'''

def update_blog_post(filepath, post_number, all_posts):
    """Update a single blog post with navigation."""
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Add Bootstrap CSS and FontAwesome if not present
    if 'bootstrap' not in content.lower():
        head_insert = '''
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
'''
        content = content.replace('</head>', head_insert + '</head>')
    
    # Remove any existing navigation headers first
    content = re.sub(r'\s*<!-- Navigation Header -->.*?</nav>', '', content, flags=re.DOTALL)
    
    # Add navigation header after <body>
    nav_header = create_navigation_header()
    content = content.replace('<body>', '<body>' + nav_header)
    
    # Wrap main content in a container
    # Find the main content between h1 and closing body/html tags
    h1_match = re.search(r'(<h1.*?</h1>)', content, re.DOTALL)
    if h1_match:
        # Get content before h1
        before_h1 = content[:h1_match.start()]
        h1_content = h1_match.group(1)
        
        # Get content after h1 until </body> or </html>
        after_h1 = content[h1_match.end():]
        
        # Clean up the after_h1 content - remove existing navigation, footer, scripts, closing tags
        after_h1 = re.sub(r'\s*<!-- Post Navigation -->.*?</nav>', '', after_h1, flags=re.DOTALL)
        after_h1 = re.sub(r'\s*<!-- Footer -->.*?</footer>', '', after_h1, flags=re.DOTALL)
        after_h1 = re.sub(r'\s*<script.*?</script>', '', after_h1, flags=re.DOTALL)
        after_h1 = re.sub(r'\s*</body>\s*</html>.*', '', after_h1, flags=re.DOTALL)
        after_h1 = after_h1.strip()
        
        # If there's no substantial content after h1, add placeholder content
        if len(after_h1.strip()) < 50:  # Very little content
            post_title = re.search(r'<title>(.*?)</title>', content)
            title_text = post_title.group(1) if post_title else "Safety Article"
            
            # Extract clean title without emojis for content
            clean_title = re.sub(r'[🌊🪣🥀🚧🍳👣📞♥️🔥🛡️💡🚨📖🕊️⚡🎯🧠💊🏠🐕👶🔐📱🍼💔🎓🏊‍♀️👨‍👩‍👧‍👦🌟🧸💚🔄📚🎈⭐🎪🌱🏅]+', '', title_text).strip()
            clean_title = re.sub(r': .*', '', clean_title)  # Remove subtitle after colon
            
            after_h1 = f'''
                <div class="alert alert-info">
                    <p><strong>This article is coming soon!</strong></p>
                    <p>We're working on comprehensive content about <em>{clean_title.lower()}</em> to help keep Australian children safe.</p>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <h2>What We'll Cover</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✓ Essential safety guidelines</li>
                            <li class="list-group-item">✓ Common risks and how to avoid them</li>
                            <li class="list-group-item">✓ Expert recommendations</li>
                            <li class="list-group-item">✓ Practical tips for Australian families</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Need Help Now?</h5>
                                <p class="card-text small">For immediate safety concerns:</p>
                                <a href="tel:000" class="btn btn-danger btn-sm d-block mb-2">🚨 Emergency: 000</a>
                                <a href="tel:1800551800" class="btn btn-primary btn-sm d-block">Kids Helpline: 1800 55 1800</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <p class="text-muted"><small>Check back soon for the complete article, or browse our other safety resources below.</small></p>
                </div>
            '''
        
        # Create the properly wrapped content
        wrapped_content = f'''
    <main class="py-4">
        <div class="container">
            <article class="blog-post">
                {h1_content}
                {after_h1}
            </article>
        </div>
    </main>
'''
        
        # Rebuild the content
        content = before_h1 + wrapped_content
    
    # Add post navigation
    post_nav = create_post_navigation(post_number, all_posts)
    content += post_nav
    
    # Add footer
    footer = create_footer()
    content += footer
    
    # Add Bootstrap JS before closing body
    if 'bootstrap.bundle.min.js' not in content:
        js_code = '''
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
'''
        content += js_code
    
    # Close body and html tags
    content += '\n</body>\n</html>'
    
    # Write back to file
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
    
    print(f"Updated {filepath}")

def main():
    """Main function to update all blog posts."""
    posts_dir = Path('posts')
    
    if not posts_dir.exists():
        print("Posts directory not found!")
        return
    
    # Get all HTML files and extract post information
    html_files = list(posts_dir.glob('*.html'))
    html_files.sort()
    
    # Create list of (post_number, filename) tuples
    all_posts = []
    for filepath in html_files:
        post_number, slug = get_post_info(filepath.name)
        if post_number:
            all_posts.append((post_number, filepath.name))
    
    # Sort by post number
    all_posts.sort(key=lambda x: x[0])
    
    total_posts = len(all_posts)
    print(f"Found {total_posts} blog posts to update")
    
    # Update each post with navigation
    for post_number, filename in all_posts:
        filepath = posts_dir / filename
        update_blog_post(filepath, post_number, all_posts)
    
    print("\nBlog post navigation update complete!")
    print("\nFeatures added:")
    print("- Bootstrap CSS and FontAwesome icons")
    print("- Navigation header with Home and All Articles links")
    print("- Logo and site branding")
    print("- Previous/Next post navigation")
    print("- Consistent footer with emergency contacts")
    print("- Responsive container wrapping")

if __name__ == '__main__':
    main()

