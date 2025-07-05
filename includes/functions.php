<?php
/**
 * Common utility functions for the Protect Children Australia website
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Sanitize user input to prevent XSS attacks
 * 
 * @param string $data Input data to sanitize
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Redirect to another page
 * 
 * @param string $location URL to redirect to
 * @return void
 */
function redirect($location) {
    header("Location: {$location}");
    exit;
}

/**
 * Check if user is logged in
 * 
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check if user is an admin
 * 
 * @return bool True if user is an admin, false otherwise
 */
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Get current user data
 * 
 * @return array|false User data or false if not logged in
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return false;
    }
    
    $sql = "SELECT id, username, email, role, created_at FROM users WHERE id = ?";
    return fetchSingle($sql, [$_SESSION['user_id']]);
}

/**
 * Format date in Australian format (DD/MM/YYYY)
 * 
 * @param string $date Date string
 * @param bool $includeTime Whether to include time
 * @return string Formatted date
 */
function formatDate($date, $includeTime = false) {
    $timestamp = strtotime($date);
    return $includeTime 
        ? date('d/m/Y H:i', $timestamp) 
        : date('d/m/Y', $timestamp);
}

/**
 * Create URL-friendly slug from a string
 * 
 * @param string $string Input string
 * @return string URL-friendly slug
 */
function createSlug($string) {
    // Replace non-alphanumeric characters with hyphens
    $slug = preg_replace('/[^a-z0-9]+/i', '-', strtolower(trim($string)));
    // Remove duplicate hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    // Remove leading and trailing hyphens
    return trim($slug, '-');
}

/**
 * Truncate text to a specified length
 * 
 * @param string $text Input text
 * @param int $length Maximum length
 * @param string $append Text to append if truncated
 * @return string Truncated text
 */
function truncateText($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}

/**
 * Display error message
 * 
 * @param string $message Error message
 * @return string HTML for error message
 */
function displayError($message) {
    return '<div class="alert alert-danger" role="alert">' . $message . '</div>';
}

/**
 * Display success message
 * 
 * @param string $message Success message
 * @return string HTML for success message
 */
function displaySuccess($message) {
    return '<div class="alert alert-success" role="alert">' . $message . '</div>';
}

/**
 * Get all categories
 * 
 * @return array Array of categories
 */
function getAllCategories() {
    $sql = "SELECT id, name, description, slug FROM categories ORDER BY name";
    return fetchAll($sql);
}

/**
 * Get category by slug
 * 
 * @param string $slug Category slug
 * @return array|false Category data or false if not found
 */
function getCategoryBySlug($slug) {
    $sql = "SELECT id, name, description, slug FROM categories WHERE slug = ?";
    return fetchSingle($sql, [$slug]);
}

/**
 * Get recent posts
 * 
 * @param int $limit Number of posts to retrieve
 * @return array Array of recent posts
 */
function getRecentPosts($limit = 5) {
    $sql = "SELECT p.id, p.title, p.content, p.featured_image, p.created_at, 
                   c.name as category_name, c.slug as category_slug,
                   u.username as author
            FROM posts p
            JOIN categories c ON p.category_id = c.id
            JOIN users u ON p.author_id = u.id
            ORDER BY p.created_at DESC
            LIMIT ?";
    
    return fetchAll($sql, [$limit]);
}

/**
 * Get resources by category
 * 
 * @param int $categoryId Category ID
 * @param int $limit Number of resources to retrieve
 * @return array Array of resources
 */
function getResourcesByCategory($categoryId, $limit = 10) {
    $sql = "SELECT id, title, description, link, created_at
            FROM resources
            WHERE category_id = ?
            ORDER BY created_at DESC
            LIMIT ?";
    
    return fetchAll($sql, [$categoryId, $limit]);
}

/**
 * Generate a random token
 * 
 * @param int $length Token length
 * @return string Random token
 */
function generateToken($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Log activity
 * 
 * @param string $action Action performed
 * @param string $details Additional details
 * @param int $userId User ID or 0 for guest
 * @return bool Success status
 */
function logActivity($action, $details = '', $userId = 0) {
    // In a production environment, you would implement a proper logging system
    // For simplicity, we're just using error_log here
    $logMessage = date('Y-m-d H:i:s') . " | User ID: {$userId} | {$action} | {$details}";
    return error_log($logMessage, 3, ROOT_PATH . '/logs/activity.log');
}

/**
 * Australian state dropdown options
 * 
 * @param string $selected Currently selected state
 * @return string HTML options for state dropdown
 */
function getStateOptions($selected = '') {
    $states = [
        'ACT' => 'Australian Capital Territory',
        'NSW' => 'New South Wales',
        'NT'  => 'Northern Territory',
        'QLD' => 'Queensland',
        'SA'  => 'South Australia',
        'TAS' => 'Tasmania',
        'VIC' => 'Victoria',
        'WA'  => 'Western Australia'
    ];
    
    $options = '';
    foreach ($states as $code => $name) {
        $isSelected = ($selected === $code) ? ' selected' : '';
        $options .= "<option value=\"{$code}\"{$isSelected}>{$name}</option>";
    }
    
    return $options;
}

