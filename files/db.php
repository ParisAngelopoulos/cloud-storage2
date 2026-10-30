<?php
// The database is a SQLite file in private/ (not reachable from the web). The first time it is
// missing, it is created from private/database.sql with the example data, so no setup is needed.
$file = __DIR__ . '/private/database.sqlite';
$new = !is_file($file);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO('sqlite:' . $file, null, null, $options);
$pdo->exec('PRAGMA foreign_keys = ON');
if ($new) {
    $pdo->exec(file_get_contents(__DIR__ . '/private/database.sql'));
}
?>
