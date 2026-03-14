<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Log.php';

class AuthController {
    private $pdo;
    private $userModel;
    private $logModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->logModel = new Log($pdo);
    }

    public function login() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                $user = $this->userModel->findByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $this->logModel->create($user['id'], 'login');
                    header('Location: /dashboard');
                    exit;
                } else {
                    $message = 'Identifiants incorrects';
                }
            } else {
                $message = 'Veuillez saisir un nom d\'utilisateur et un mot de passe.';
            }
        }

        // Load view
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function register() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                if ($this->userModel->findByUsername($username)) {
                    $message = 'Nom d\'utilisateur déjà pris.';
                } else {
                    $this->userModel->create($username, $password);
                    $message = 'Inscription réussie. Vous pouvez maintenant vous connecter.';
                }
            } else {
                $message = 'Veuillez saisir un nom d\'utilisateur et un mot de passe.';
            }
        }

        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
?>