<?php

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$routes = [
    '/' => __DIR__ . '/../index.php',
    '/index.php' => __DIR__ . '/../index.php',

    '/pages/auth/login.php' => __DIR__ . '/../pages/auth/login.php',
    '/pages/students/index.php' => __DIR__ . '/../pages/students/index.php',
    '/pages/students/edit.php' => __DIR__ . '/../pages/students/edit.php',

    '/api/auth/login.php' => __DIR__ . '/auth/login.php',
    '/api/auth/signup.php' => __DIR__ . '/auth/signup.php',

    '/api/students/count.php' => __DIR__ . '/students/count.php',
    '/api/students/create.php' => __DIR__ . '/students/create.php',
    '/api/students/delete.php' => __DIR__ . '/students/delete.php',
    '/api/students/export.php' => __DIR__ . '/students/export.php',
    '/api/students/inline-update.php' => __DIR__ . '/students/inline-update.php',
    '/api/students/update.php' => __DIR__ . '/students/update.php',
];

if (!isset($routes[$path])) {
    http_response_code(404);
    exit('Not found');
}

require $routes[$path];
