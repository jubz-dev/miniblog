<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'miniblog_db');
define('DB_USER', 'root');
define('DB_PASS', 'dbPassword');
define('BASE_URL', '');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
