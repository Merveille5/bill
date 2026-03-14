<?php
class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $type, $amount, $currency = 'FC', $operator = null, $agentId = null) {
        $stmt = $this->pdo->prepare('INSERT INTO transactions (user_id, type, amount, currency, operator, agent_id) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$userId, $type, $amount, $currency, $operator, $agentId]);
        return $this->pdo->lastInsertId();
    }

    public function getByUserId($userId) {
        $stmt = $this->pdo->prepare('SELECT t.*, a.name as agent_name FROM transactions t LEFT JOIN agents a ON t.agent_id = a.id WHERE t.user_id = ? ORDER BY t.created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingByAgent($agentId) {
        $stmt = $this->pdo->prepare('SELECT t.*, u.username FROM transactions t JOIN users u ON t.user_id = u.id WHERE t.agent_id = ? AND t.status = "pending"');
        $stmt->execute([$agentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function confirm($id) {
        $stmt = $this->pdo->prepare('UPDATE transactions SET status = "confirmed", confirmed_at = NOW() WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM transactions WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>