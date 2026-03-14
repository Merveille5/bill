<?php
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Agent.php';

class AgentController {
    private $pdo;
    private $transactionModel;
    private $userModel;
    private $agentModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->transactionModel = new Transaction($pdo);
        $this->userModel = new User($pdo);
        $this->agentModel = new Agent($pdo);
    }

    public function dashboard() {
        session_start();
        // For demo, assume agent is logged in with agent_id in session
        // In production, you'd have agent authentication
        $agentId = $_SESSION['agent_id'] ?? 1; // Default to first agent for demo

        $agent = $this->agentModel->findById($agentId);
        
        // If no agent found, create a default one or show error
        if (!$agent) {
            // Try to get any active agent or create a default one
            $agent = $this->agentModel->getRandomActive();
            if (!$agent) {
                // Create a default agent if none exists
                $this->createDefaultAgent();
                $agent = $this->agentModel->findById(1);
            }
            if ($agent) {
                $_SESSION['agent_id'] = $agent['id'];
                $agentId = $agent['id'];
            }
        }

        $pendingTransactions = $this->transactionModel->getPendingByAgent($agentId);

        require_once __DIR__ . '/../../views/agent/dashboard.php';
    }

    private function createDefaultAgent() {
        $stmt = $this->pdo->prepare('INSERT INTO agents (name, airtel_phone, orange_phone, vodacom_phone, afrimoney_phone, usdt_balance) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute(['Agent Demo', '+243811111111', '+243822222222', '+243833333333', '+243844444444', 1000.00]);
    }

    public function confirmTransaction() {
        session_start();
        $agentId = $_SESSION['agent_id'] ?? 1;
        $transactionId = $_POST['transaction_id'] ?? 0;

        if ($transactionId > 0) {
            $transaction = $this->transactionModel->findById($transactionId);
            if ($transaction && $transaction['agent_id'] == $agentId && $transaction['status'] == 'pending') {
                $this->transactionModel->confirm($transactionId, $agentId);
                // Update user balance
                $user = $this->userModel->findById($transaction['user_id']);
                if ($transaction['type'] == 'deposit') {
                    if ($transaction['currency'] == 'FC') {
                        $newBalance = $user['balance'] + $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $newBalance);
                    } elseif ($transaction['currency'] == 'USD') {
                        $newBalance = $user['balance'] + $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $newBalance);
                    } elseif ($transaction['currency'] == 'USDT') {
                        $newUsdt = $user['usdt_balance'] + $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $user['balance'], $newUsdt);
                    }
                } elseif ($transaction['type'] == 'withdrawal') {
                    if ($transaction['currency'] == 'FC') {
                        $newBalance = $user['balance'] - $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $newBalance);
                    } elseif ($transaction['currency'] == 'USD') {
                        $newBalance = $user['balance'] - $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $newBalance);
                    } elseif ($transaction['currency'] == 'USDT') {
                        $newUsdt = $user['usdt_balance'] - $transaction['amount'];
                        $this->userModel->updateBalance($user['id'], $user['balance'], $newUsdt);
                    }
                }
            }
        }

        header('Location: /agent/dashboard');
        exit;
    }

    public function cancelTransaction() {
        session_start();
        $agentId = $_SESSION['agent_id'] ?? 1;
        $transactionId = $_POST['transaction_id'] ?? 0;

        if ($transactionId > 0) {
            $transaction = $this->transactionModel->findById($transactionId);
            if ($transaction && $transaction['agent_id'] == $agentId && $transaction['status'] == 'pending') {
                $this->transactionModel->cancel($transactionId, $agentId);
            }
        }

        header('Location: /agent/dashboard');
        exit;
    }
}
?>