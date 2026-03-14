<?php
ob_start();
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ . '/../app/config/database.php';
$pdo = getPDO();
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AccountController.php';
require_once __DIR__ . '/../app/controllers/AgentController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$authController = new AuthController($pdo);
$accountController = new AccountController($pdo);
$agentController = new AgentController($pdo);
$adminController = new AdminController($pdo);

switch ($request) {
    case '/':
    case '/login':
        if ($method === 'GET') {
            $authController->login();
        } elseif ($method === 'POST') {
            $authController->login();
        }
        break;
    case '/register':
        if ($method === 'GET') {
            $authController->register();
        } elseif ($method === 'POST') {
            $authController->register();
        }
        break;
    case '/logout':
        $authController->logout();
        break;
    case '/dashboard':
        $accountController->dashboard();
        break;
    case '/deposit':
        if ($method === 'GET') {
            $accountController->deposit();
        } elseif ($method === 'POST') {
            $accountController->deposit();
        }
        break;
    case '/withdraw':
        if ($method === 'GET') {
            $accountController->withdraw();
        } elseif ($method === 'POST') {
            $accountController->withdraw();
        }
        break;
    case '/convert':
        if ($method === 'GET') {
            $accountController->convert();
        } elseif ($method === 'POST') {
            $accountController->convert();
        }
        break;
    case '/logs':
        $accountController->logs();
        break;
    case '/agent/dashboard':
        $agentController->dashboard();
        break;
    case '/agent/confirm':
        if ($method === 'POST') {
            $agentController->confirmTransaction();
        }
        break;
    case '/agent/cancel':
        if ($method === 'POST') {
            $agentController->cancelTransaction();
        }
        break;
    case '/admin/dashboard':
        if ($method === 'GET') {
            $adminController->dashboard();
        } elseif ($method === 'POST') {
            $adminController->dashboard();
        }
        break;
}
?>