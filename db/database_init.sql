-- Protect Children Australia Website Database Initialization
-- This file creates the database and tables for the Protect Children Australia website
-- It also inserts initial data for categories and admin user

-- Create database
CREATE DATABASE IF NOT EXISTS protect_children;
USE protect_children;

-- Drop tables if they exist to ensure clean initialization
DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS newsletter_subscribers; 
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS resources;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

-- Create users table
-- Stores user information including admin and regular users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Will store password hash, not plaintext
    role ENUM('admin', 'editor', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_email (email),
    INDEX idx_user_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create categories table
-- Stores different safety categories for organizing content
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    slug VARCHAR(100) NOT NULL UNIQUE,
    INDEX idx_category_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create posts table
-- Stores blog posts and articles
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    featured_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    INDEX idx_post_author (author_id),
    INDEX idx_post_category (category_id),
    FULLTEXT INDEX idx_post_content (title, content)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create resources table
-- Stores safety resources and helpful links
CREATE TABLE resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    link VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    INDEX idx_resource_category (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create comments table
-- Stores user comments on blog posts
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_comment_post (post_id),
    INDEX idx_comment_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create newsletter_subscribers table
-- Stores information about users subscribed to the newsletter
CREATE TABLE newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    name VARCHAR(100),
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_subscriber_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create contact_messages table
-- Stores messages sent through the contact form
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_contact_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data for categories
INSERT INTO categories (name, description, slug) VALUES
('Online Safety', 'Protecting children from online threats including cyberbullying, inappropriate content, and online predators.', 'online-safety'),
('Physical Safety', 'Tips and guidelines for keeping children safe in various physical environments including water safety, road safety, and stranger danger.', 'physical-safety'),
('Mental Health', 'Resources for supporting children\'s mental wellbeing, preventing bullying, and promoting emotional resilience.', 'mental-health'),
('Emergency Response', 'Information on how to respond to emergencies involving children, including first aid and emergency contacts.', 'emergency-response'),
('Educational Resources', 'Educational materials for parents, teachers, and children about various safety topics.', 'educational-resources'),
('Parenting Tips', 'Advice and guidance for parents on raising safe and healthy children in Australia.', 'parenting-tips'),
('School Safety', 'Information about keeping children safe in school environments and during school activities.', 'school-safety'),
('Legal Information', 'Important legal information regarding child protection laws in Australia.', 'legal-information');

-- Insert admin user (password will be hashed in PHP before insertion in real application)
-- This is just a placeholder. In production, passwords should NEVER be stored in plaintext
-- The actual insertion of admin users should be done through the application's user registration system
-- where passwords are properly hashed using PHP's password_hash() function
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@protectchildren.com.au', 'PLACEHOLDER_FOR_HASHED_PASSWORD', 'admin');

-- Insert sample resources
INSERT INTO resources (title, description, link, category_id) VALUES
('eSafety Commissioner', 'Australia\'s official online safety organization providing resources and reporting tools.', 'https://www.esafety.gov.au/', 1),
('Kids Helpline', 'Free, private and confidential 24/7 phone and online counselling service for young people aged 5 to 25.', 'https://kidshelpline.com.au/', 3),
('Royal Life Saving Australia', 'Information about water safety for children of all ages.', 'https://www.royallifesaving.com.au/', 2),
('Australian Red Cross First Aid', 'First aid training and resources specifically for handling children\'s emergencies.', 'https://www.redcross.org.au/first-aid/', 4),
('Raising Children Network', 'The Australian parenting website with comprehensive resources for parents.', 'https://raisingchildren.net.au/', 5);

-- Note: In a production environment, more sample data would be added for posts and other content
-- This initialization file focuses on setting up the database structure with basic category and resource information

