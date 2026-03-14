<?php
class Agent {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRandomActive() {
        $stmt = $this->pdo->prepare('SELECT * FROM agents WHERE is_active = 1 ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM agents WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        return $this->getById($id);
    }

    public function updateUsdtBalance($id, $amount) {
        $stmt = $this->pdo->prepare('UPDATE agents SET usdt_balance = usdt_balance + ? WHERE id = ?');
        return $stmt->execute([$amount, $id]);
    }
}
?>