<?php
session_start();
require_once '../config/config.php';
require_once '../config/database.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require_once ROOT . '/views/user/home.php';
        break;
    case 'register':
        require_once ROOT . '/views/auth_user/register.php';
        break;
    case 'login':
        require_once ROOT . '/views/auth_user/login.php';
        break;
    case 'logout':
        require_once ROOT . '/views/auth_user/logout.php';
        break;
}