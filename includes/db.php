<?php
/**
 * Database Connection File
 * Establishes a secure connection to the MySQL database
 */

// Prevent direct access to this file
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// Include configuration file if not already included
if (!defined('DB_HOST')) {
    require_once 'config.php';
}

/**
 * Get a database connection
 * Uses PDO for secure database interactions
 * 
 * @return PDO Database connection object
 */
function getDbConnection() {
    static $pdo;
    
    if (!$pdo) {
        try {
            // Set DSN (Data Source Name)
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            
            // Set options
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            
            // Create a new PDO instance
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error (don't expose details to the user)
            error_log('Database Connection Error: ' . $e->getMessage());
            die('A database connection error occurred. Please try again later.');
        }
    }
    
    return $pdo;
}

/**
 * Execute a SQL query with prepared statements
 * 
 * @param string $sql SQL query with placeholders
 * @param array $params Parameters to bind to the query
 * @return PDOStatement|false Statement object or false on failure
 */
function executeQuery($sql, $params = []) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log('Query Error: ' . $e->getMessage() . ' - SQL: ' . $sql);
        return false;
    }
}

/**
 * Get a single record from the database
 * 
 * @param string $sql SQL query with placeholders
 * @param array $params Parameters to bind to the query
 * @return array|false Single record as associative array or false if not found
 */
function fetchSingle($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt ? $stmt->fetch() : false;
}

/**
 * Get multiple records from the database
 * 
 * @param string $sql SQL query with placeholders
 * @param array $params Parameters to bind to the query
 * @return array Array of records as associative arrays
 */
function fetchAll($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt ? $stmt->fetchAll() : [];
}

/**
 * Insert a record into the database
 * 
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @return int|false Last insert ID or false on failure
 */
function insertRecord($table, $data) {
    try {
        $pdo = getDbConnection();
        
        $columns = array_keys($data);
        $placeholders = array_fill(0, count($columns), '?');
        
        $sql = "INSERT INTO {$table} (" . implode(', ', $columns) . ") 
                VALUES (" . implode(', ', $placeholders) . ")";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log('Insert Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Update a record in the database
 * 
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @param string $whereCol Where condition column
 * @param mixed $whereVal Where condition value
 * @return int|false Number of affected rows or false on failure
 */
function updateRecord($table, $data, $whereCol, $whereVal) {
    try {
        $pdo = getDbConnection();
        
        $setClauses = [];
        $params = [];
        
        foreach ($data as $column => $value) {
            $setClauses[] = "{$column} = ?";
            $params[] = $value;
        }
        
        $params[] = $whereVal;
        
        $sql = "UPDATE {$table} SET " . implode(', ', $setClauses) . " WHERE {$whereCol} = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->rowCount();
    } catch (PDOException $e) {
        error_log('Update Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete a record from the database
 * 
 * @param string $table Table name
 * @param string $whereCol Where condition column
 * @param mixed $whereVal Where condition value
 * @return int|false Number of affected rows or false on failure
 */
function deleteRecord($table, $whereCol, $whereVal) {
    try {
        $pdo = getDbConnection();
        
        $sql = "DELETE FROM {$table} WHERE {$whereCol} = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$whereVal]);
        
        return $stmt->rowCount();
    } catch (PDOException $e) {
        error_log('Delete Error: ' . $e->getMessage());
        return false;
    }
}

