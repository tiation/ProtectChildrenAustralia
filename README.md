# Protect Children Australia Website

A comprehensive resource website focused on child safety in Australia, providing information, resources, and support for parents, educators, and caregivers.

## Project Overview

The Protect Children Australia website serves as a central hub for child safety information specific to Australian contexts. The site aims to educate and empower parents, educators, and caregivers with knowledge and resources to protect children from various risks including online dangers, physical safety hazards, mental health challenges, and emergency situations.

**Target Audience:**
- Parents and family members
- Teachers and school administrators
- Childcare professionals
- Community organizations working with children
- General public interested in child safety

The website takes a safety-first approach, providing practical, evidence-based information tailored to Australian contexts and regulations.

## Features

### Content Features
- **Categorized Safety Information**: Content organized by safety categories (online, physical, mental health, etc.)
- **Resource Library**: Curated links to external resources and helpful organizations
- **Blog System**: Regular articles on child safety topics
- **Emergency Resources**: Quick access to critical safety information and contacts

### User Features
- **Mobile-Responsive Design**: Fully functional across all device sizes
- **Search Functionality**: Find content by keyword across the site
- **Newsletter Subscription**: Stay updated with the latest safety information
- **Contact Form**: Get in touch with questions or concerns
- **Category Filtering**: Browse content by specific safety categories
- **Breadcrumb Navigation**: Easy site navigation

### Admin Features
- **Secure Admin Dashboard**: Manage all website content
- **Content Management**: Add, edit, and delete posts and resources
- **User Management**: Control admin access
- **Subscriber Management**: View and manage newsletter subscribers
- **Message Management**: Process contact form submissions

## Technical Stack

The website is built using the following technologies:

- **Frontend**:
  - HTML5
  - CSS3 with responsive design
  - JavaScript (vanilla JS with some jQuery support)
  - Bootstrap 5 framework
  - Font Awesome icons

- **Backend**:
  - PHP 7.4+
  - MySQL database
  - PDO for database interactions

- **Security**:
  - Prepared statements for SQL queries
  - Input sanitization
  - Password hashing
  - Session management
  - CSRF protection

## File Structure

```
www.protectchildren.com.au/
├── admin/                  # Admin area files
│   ├── index.php           # Admin dashboard
│   ├── posts.php           # Manage blog posts
│   ├── categories.php      # Manage categories
│   ├── resources.php       # Manage resources
│   └── ...                 # Other admin pages
├── css/                    # Stylesheet files
│   └── styles.css          # Main stylesheet
├── db/                     # Database files
│   └── database_init.sql   # Database initialization script
├── images/                 # Image assets
│   ├── logo.png            # Site logo
│   └── ...                 # Other images
├── includes/               # PHP include files
│   ├── config.php          # Configuration settings
│   ├── db.php              # Database functions
│   ├── functions.php       # Utility functions
│   ├── header.php          # Site header template
│   ├── footer.php          # Site footer template
│   └── navbar.php          # Navigation bar template
├── js/                     # JavaScript files
│   └── scripts.js          # Main JavaScript file
├── index.php               # Homepage
├── blog.php                # Blog listing page
├── category.php            # Category page
├── contact.php             # Contact form
├── newsletter-subscribe.php # Newsletter handler
└── README.md               # This file
```

## Setup Instructions

Follow these steps to set up the website on your local environment:

1. **Prerequisites**:
   - Web server (Apache/Nginx)
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Git (optional)

2. **Clone or download the repository**:
   ```bash
   git clone https://github.com/yourusername/www.protectchildren.com.au.git
   ```
   
   Or download and extract the ZIP file.

3. **Configure the web server**:
   - Point your web server to the project directory
   - Ensure PHP is properly configured with the required extensions:
     - PDO
     - PDO_MySQL
     - GD (for image processing)

4. **Update configuration**:
   - Open `includes/config.php`
   - Update the database credentials and site URL to match your environment:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'protect_children');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('SITE_URL', 'http://localhost/www.protectchildren.com.au');
     ```

5. **Set up the database** (see Database Setup section below)

6. **Create required directories**:
   ```bash
   mkdir -p logs uploads
   chmod 755 logs uploads
   ```

7. **Test the installation**:
   - Open your browser and navigate to the site URL
   - Verify that the homepage loads correctly
   - Test navigation to various sections

## Database Setup

1. **Create the database**:
   ```sql
   CREATE DATABASE protect_children;
   ```

2. **Create a database user** (optional but recommended):
   ```sql
   CREATE USER 'protect_user'@'localhost' IDENTIFIED BY 'secure_password';
   GRANT ALL PRIVILEGES ON protect_children.* TO 'protect_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. **Initialize the database**:
   ```bash
   mysql -u your_username -p protect_children < db/database_init.sql
   ```
   
   Alternatively, you can use phpMyAdmin or another MySQL management tool to import the SQL file.

4. **Verify the database setup**:
   - Check that all tables were created successfully:
     - users
     - categories
     - posts
     - resources
     - comments
     - newsletter_subscribers
     - contact_messages

## Administration

The admin area allows authorized users to manage all website content and functionality.

### Accessing the Admin Area

1. Navigate to `www.protectchildren.com.au/admin/` in your browser
2. Log in with admin credentials:
   - Default username: `admin`
   - Default password: See your installation notes (change immediately after first login)

### Admin Capabilities

- **Dashboard**: View site statistics and recent activity
- **Posts**: Add, edit, delete blog posts
- **Categories**: Manage content categories
- **Resources**: Add and manage external resources
- **Users**: Manage admin users and permissions
- **Subscribers**: View and manage newsletter subscribers
- **Messages**: Read and respond to contact form submissions
- **Settings**: Configure website settings

### Adding Content

1. **To add a blog post**:
   - Go to Posts > Add New
   - Fill in the title, content, select category
   - Upload a featured image (optional)
   - Click Publish

2. **To add a resource**:
   - Go to Resources > Add New
   - Enter the title, description, and external URL
   - Select a category
   - Click Save

## Security Considerations

The website implements several security measures:

1. **Database Security**:
   - All database queries use prepared statements via PDO
   - No direct SQL queries with user input
   - Database credentials are stored in a separate config file

2. **User Authentication**:
   - Passwords are hashed using PHP's password_hash() function
   - Session management with secure cookie settings
   - Role-based access control for admin features

3. **Form Security**:
   - Input sanitization for all user-submitted data
   - CSRF protection tokens for forms
   - Validation on both client and server sides

4. **General Security**:
   - Direct access prevention for include files
   - Error handling that doesn't expose sensitive information
   - Regular security updates recommended

### Security Recommendations

- Change the default admin password immediately after installation
- Regularly back up the database
- Keep PHP and all libraries updated
- Consider implementing additional security measures like:
  - SSL certificate (HTTPS)
  - Fail2Ban for login protection
  - Web Application Firewall

## Future Enhancements

Potential improvements for future development:

1. **Content and Features**:
   - Age-specific safety guides
   - Interactive safety checklists
   - Printable resources for parents and educators
   - Safety event calendar
   - User forums or discussion boards
   - Multi-language support for diverse Australian communities

2. **Technical Enhancements**:
   - Advanced search functionality with filters
   - Content rating system
   - User accounts for parents/educators
   - Email notification system
   - Integration with social media platforms
   - Progressive Web App (PWA) capabilities
   - Content versioning system

3. **Administrative Improvements**:
   - Enhanced analytics dashboard
   - Automated content moderation
   - Bulk content management tools
   - Advanced user role management
   - Automated backup system

## Contact Information

For questions, support, or contributions:

- **Website Administrator**: admin@protectchildren.com.au
- **Technical Support**: support@protectchildren.com.au
- **Content Team**: content@protectchildren.com.au
- **General Inquiries**: info@protectchildren.com.au

For emergencies involving children, please contact emergency services directly at 000.

---

**Disclaimer**: This website is created to provide information and resources. It is not a substitute for professional advice. In emergencies, always contact appropriate emergency services.

