<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('DB_HOST');
$port = (int) (getenv('DB_PORT') ?: 3306);
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME') ?: 'defaultdb';

if (!$host || !$user || !$password) {
    http_response_code(500);
    exit('Database configuration is missing');
}

$conn = mysqli_init();
$caPath = __DIR__ . '/ca.pem';

if (is_file($caPath)) {
    $conn->ssl_set(null, null, $caPath, null, null);
}

try {
    $conn->real_connect(
        $host,
        $user,
        $password,
        $database,
        $port,
        null,
        MYSQLI_CLIENT_SSL
    );

    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    exit('Database connection failed');
}
