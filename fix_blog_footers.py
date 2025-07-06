#!/usr/bin/env python3
"""
Script to fix footer height issue on all blog posts.
Adds CSS to limit footer height and make it scrollable.
"""

import os
import re
from pathlib import Path

def fix_blog_footer(filepath):
    """Fix footer height in a single blog post."""
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Check if footer fix CSS is already present
    if 'Footer Height Fix' in content:
        print(f"Skipping {filepath} - already has footer fix")
        return
    
    # Add the footer fix CSS before the closing body tag
    footer_fix_css = '''
    <!-- Footer Height Fix -->
    <style>
        .site-footer {
            max-height: 250px !important;
            overflow-y: auto !important;
            padding: 1.5rem 0 !important;
        }
        .site-footer h4, .site-footer h5, .site-footer h6 {
            font-size: 1rem !important;
            margin-bottom: 0.5rem !important;
        }
        .site-footer p {
            font-size: 0.85rem !important;
            margin-bottom: 0.25rem !important;
        }
        .site-footer ul {
            font-size: 0.85rem !important;
        }
        .site-footer li {
            margin-bottom: 0.25rem !important;
        }
        /* Ensure body is properly structured for footer at bottom */
        body {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
        }
        main {
            flex: 1 !important;
        }
    </style>
    
'''
    
    # Insert before the closing </body> tag
    if '</body>' in content:
        content = content.replace('</body>', footer_fix_css + '</body>')
        
        # Write back to file
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        
        print(f"Fixed footer in {filepath}")
    else:
        print(f"Warning: No </body> tag found in {filepath}")

def main():
    """Main function to fix all blog post footers."""
    posts_dir = Path('posts')
    
    if not posts_dir.exists():
        print("Posts directory not found!")
        return
    
    # Get all HTML files
    html_files = list(posts_dir.glob('*.html'))
    html_files.sort()
    
    print(f"Found {len(html_files)} blog posts to fix")
    
    fixed_count = 0
    for filepath in html_files:
        try:
            fix_blog_footer(filepath)
            fixed_count += 1
        except Exception as e:
            print(f"Error fixing {filepath}: {e}")
    
    print(f"\nFixed footer in {fixed_count} blog posts")
    print("\nFooter fixes applied:")
    print("- Limited footer max-height to 250px")
    print("- Added overflow-y: auto for scrollable content")
    print("- Reduced font sizes for compact display")
    print("- Fixed body flex layout for proper positioning")

if __name__ == '__main__':
    main()

