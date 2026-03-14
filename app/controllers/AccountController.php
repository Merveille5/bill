<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Log.php';
require_once __DIR__ . '/../models/Agent.php';
require_once __DIR__ . '/../models/Config.php';

class AccountController {
    private $pdo;
    private $userModel;
    private $transactionModel;
    private $logModel;
    private $agentModel;
    private $configModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->transactionModel = new Transaction($pdo);
        $this->logModel = new Log($pdo);
        $this->agentModel = new Agent($pdo);
        $this->configModel = new Config($pdo);
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $user = $this->userModel->findById($userId);
        $transactions = $this->transactionModel->getByUserId($userId);

        require_once __DIR__ . '/../../views/account/dashboard.php';
    }

    public function deposit() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $user = $this->userModel->findById($userId);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'] ?? 0;
            $currency = $_POST['currency'] ?? 'FC';

            if ($amount > 0) {
                // Assign a random active agent
                $agent = $this->agentModel->getRandomActive();
                if ($agent) {
                    // Create pending transaction
                    $this->transactionModel->create($userId, 'deposit', $amount, $currency, null, $agent['id']);
                    $this->logModel->create($userId, 'deposit_request');
                    $message = 'Demande de dépôt soumise. En attente de confirmation par un agent.';
                } else {
                    $message = 'Aucun agent disponible. Veuillez réessayer plus tard.';
                }
            } else {
                $message = 'Montant invalide.';
            }
        }

        require_once __DIR__ . '/../../views/account/deposit.php';
    }

    public function withdraw() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $user = $this->userModel->findById($userId);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'] ?? 0;
            $currency = $_POST['currency'] ?? 'FC';

            if ($amount > 0) {
                $sufficient = ($currency == 'FC' && $user['balance'] >= $amount) ||
                              ($currency == 'USD' && $user['balance'] >= $amount) ||
                              ($currency == 'USDT' && $user['usdt_balance'] >= $amount);
                if ($sufficient) {
                    // Assign a random active agent
                    $agent = $this->agentModel->getRandomActive();
                    if ($agent) {
                        // Create pending transaction
                        $this->transactionModel->create($userId, 'withdrawal', $amount, $currency, null, $agent['id']);
                        $this->logModel->create($userId, 'withdrawal_request');
                        $message = 'Demande de retrait soumise. En attente de confirmation par un agent.';
                    } else {
                        $message = 'Aucun agent disponible. Veuillez réessayer plus tard.';
                    }
                } else {
                    $message = 'Solde insuffisant.';
                }
            } else {
                $message = 'Montant invalide.';
            }
        }

        require_once __DIR__ . '/../../views/account/withdraw.php';
    }

    public function logs() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $logs = $this->logModel->getByUserId($userId);

        require_once __DIR__ . '/../../views/account/logs.php';
    }

    public function convert() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $userId = $_SESSION['user_id'];

        $user = $this->userModel->findById($userId);
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'] ?? 0;
            $from = $_POST['from'] ?? 'FC';
            $to = $_POST['to'] ?? 'USD';

            if ($amount > 0) {
                $rate = floatval($this->configModel->getExchangeRate($from, $to));
                if ($rate > 0) {
                    if ($from == 'FC' && $to == 'USD' && $user['balance'] >= $amount) {
                        $converted = $amount * $rate;
                        $newBalance = $user['balance'] - $amount;
                        $newUsdt = $user['usdt_balance'] + $converted;
                        $this->userModel->updateBalance($userId, $newBalance, $newUsdt);
                        $this->transactionModel->create($userId, 'withdrawal', $amount, 'FC', 'convert');
                        $this->transactionModel->create($userId, 'deposit', $converted, 'USDT', 'convert');
                        $this->logModel->create($userId, 'convert');
                        $message = 'Conversion effectuée avec succès.';
                    } elseif ($from == 'USD' && $to == 'FC' && $user['usdt_balance'] >= $amount) {
                        $converted = $amount / $rate;
                        $newUsdt = $user['usdt_balance'] - $amount;
                        $newBalance = $user['balance'] + $converted;
                        $this->userModel->updateBalance($userId, $newBalance, $newUsdt);
                        $this->transactionModel->create($userId, 'withdrawal', $amount, 'USDT', 'convert');
                        $this->transactionModel->create($userId, 'deposit', $converted, 'FC', 'convert');
                        $this->logModel->create($userId, 'convert');
                        $message = 'Conversion effectuée avec succès.';
                    } else {
                        $message = 'Solde insuffisant ou paramètres invalides.';
                    }
                } else {
                    $message = 'Taux de change non disponible.';
                }
            } else {
                $message = 'Montant invalide.';
            }
        }

        require_once __DIR__ . '/../../views/account/convert.php';
    }
}
?>