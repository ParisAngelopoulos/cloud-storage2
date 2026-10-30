<?php
// On the web host, db_config.php (written on deploy, not in git) holds the login; locally XAMPP defaults
$c = is_file(__DIR__ . '/db_config.php') ? require __DIR__ . '/db_config.php' : [];
$host = $c['host'] ?? 'localhost';
$db   = $c['database'] ?? 'file_sharing';
$user = $c['user'] ?? 'root';
$pass = $c['password'] ?? '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
