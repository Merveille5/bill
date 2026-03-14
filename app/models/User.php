<?php
require_once __DIR__ . '/Wallet.php';

class User {
    private $pdo;
    private $walletModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->walletModel = new Wallet($pdo);
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare('SELECT id, password, balance, usdt_balance FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare('SELECT id, username, balance, usdt_balance FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($username, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        if ($stmt->execute([$username, $hashed])) {
            $userId = $this->pdo->lastInsertId();
            // Create wallet
            $this->walletModel->createForUser($userId);
            return true;
        }
        return false;
    }

    public function updateBalance($id, $balance, $usdt = null) {
        if ($usdt !== null) {
            $stmt = $this->pdo->prepare('UPDATE users SET balance = ?, usdt_balance = ? WHERE id = ?');
            return $stmt->execute([$balance, $usdt, $id]);
        } else {
            $stmt = $this->pdo->prepare('UPDATE users SET balance = ? WHERE id = ?');
            return $stmt->execute([$balance, $id]);
        }
    }

    public function getWallet($userId) {
        return $this->walletModel->getByUserId($userId);
    }
}
?>