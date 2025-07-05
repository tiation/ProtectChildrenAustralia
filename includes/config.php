<?php
/**
 * Configuration file for Protect Children Australia Website
 * Contains database credentials and site-wide constants
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Define site constants
define('SITE_NAME', 'Protect Children Australia');
define('SITE_URL', 'https://www.protectchildren.com.au');
define('SITE_EMAIL', 'info@protectchildren.com.au');
define('SITE_DESCRIPTION', 'A resource for protecting children from various risks in Australia');
define('SITE_KEYWORDS', 'child safety, protect children, Australia, online safety, physical safety, mental health');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'protect_children');
define('DB_USER', 'db_user'); // Change this to your actual database username
define('DB_PASS', 'db_password'); // Change this to your actual database password

// Error reporting settings
// In production, set this to 0 or E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT
// For development, you can use E_ALL for showing all errors
define('ERROR_REPORTING', E_ALL & ~E_NOTICE);
error_reporting(ERROR_REPORTING);

// Session settings
define('SESSION_NAME', 'protect_children_session');
define('SESSION_LIFETIME', 7200); // 2 hours in seconds

// Paths
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('INCLUDE_PATH', ROOT_PATH . '/includes');
define('ADMIN_PATH', ROOT_PATH . '/admin');
define('UPLOAD_PATH', ROOT_PATH . '/uploads');
define('IMAGE_PATH', ROOT_PATH . '/images');

// Security
define('HASH_COST', 12); // For password_hash() bcrypt algorithm

// Australian Emergency Contacts
define('EMERGENCY_POLICE', '000');
define('KIDS_HELPLINE', '1800 55 1800');
define('LIFELINE', '13 11 14');
define('PARENTLINE', '1300 30 1300');

