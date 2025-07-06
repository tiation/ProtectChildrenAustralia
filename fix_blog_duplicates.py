#!/usr/bin/env python3
"""
Script to fix duplicate main content in blog posts.
"""

import os
import re
from pathlib import Path

def fix_blog_post(filepath):
    """Fix duplicate main content in a single blog post."""
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remove duplicate main/div/article wrapping
    # Look for lines 34-52 duplication pattern
    lines = content.split('\n')
    
    # Find the problematic duplication around lines 34-52
    found_dup = False
    for i in range(len(lines)):
        if i < len(lines) - 20:  # Make sure we have enough lines ahead
            if ('<main class="py-4">' in lines[i] and 
                '<div class="container">' in lines[i+1] and 
                '<article class="blog-post">' in lines[i+2] and 
                '<main class="py-4">' in lines[i+4] and 
                '<div class="container">' in lines[i+5] and 
                '<article class="blog-post">' in lines[i+6]):
                
                # Remove the first duplicate (lines i to i+18)
                del lines[i:i+19]  # Remove the entire first duplicate block
                found_dup = True
                break
    
    if found_dup:
        content = '\n'.join(lines)
        print(f"Fixed duplicate content in {filepath}")
        
        # Write back to file
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
    
def main():
    """Main function to fix all blog posts."""
    posts_dir = Path('posts')
    
    if not posts_dir.exists():
        print("Posts directory not found!")
        return
    
    # Get all HTML files
    html_files = list(posts_dir.glob('*.html'))
    html_files.sort()
    
    fixed_count = 0
    for filepath in html_files:
        try:
            fix_blog_post(filepath)
            fixed_count += 1
        except Exception as e:
            print(f"Error fixing {filepath}: {e}")
    
    print(f"\nFixed {fixed_count} blog posts")

if __name__ == '__main__':
    main()

