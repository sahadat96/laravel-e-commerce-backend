
<?php
// Display all PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if PDO is available
echo 'PDO class exists: ' . (class_exists('PDO') ? 'Yes' : 'No') . '<br>';
echo 'PDO MySQL extension loaded: ' . (extension_loaded('pdo_mysql') ? 'Yes' : 'No') . '<br>';

// List all loaded extensions
echo '<h3>Loaded Extensions:</h3>';
echo '<pre>';
print_r(get_loaded_extensions());
echo '</pre>';

// Try to connect to MySQL
try {
    $host = '127.0.0.1';
    $dbname = 'paikarimela';
    $username = 'root';
    $password = '';
    
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo '<h3>Successfully connected to MySQL!</h3>';
} catch (PDOException $e) {
    echo '<h3>Failed to connect to MySQL:</h3>';
    echo $e->getMessage();
}

exit;
?>