<?php
class Log {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $action) {
        $stmt = $this->pdo->prepare('INSERT INTO logs (user_id, action) VALUES (?, ?)');
        return $stmt->execute([$userId, $action]);
    }

    public function getByUserId($userId) {
        $stmt = $this->pdo->prepare('SELECT action, created_at FROM logs WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>