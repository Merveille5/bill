<?php
class Wallet {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createForUser($userId) {
        // Generate a fake Tron address
        $address = 'T' . bin2hex(random_bytes(20));
        $stmt = $this->pdo->prepare('INSERT INTO user_wallets (user_id, tron_address) VALUES (?, ?)');
        $stmt->execute([$userId, $address]);
        return $address;
    }

    public function getByUserId($userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM user_wallets WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>