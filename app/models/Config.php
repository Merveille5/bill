<?php
class Config {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function get($key) {
        $stmt = $this->pdo->prepare('SELECT value FROM config WHERE key_name = ?');
        $stmt->execute([$key]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['value'] : null;
    }

    public function set($key, $value, $description = null) {
        $stmt = $this->pdo->prepare('INSERT INTO config (key_name, value, description) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value), description = VALUES(description)');
        return $stmt->execute([$key, $value, $description]);
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM config ORDER BY key_name');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExchangeRate($from, $to) {
        if ($from === 'FC' && $to === 'USD') {
            return $this->get('fc_to_usd_rate');
        } elseif ($from === 'USD' && $to === 'FC') {
            return $this->get('usd_to_fc_rate');
        }
        return null;
    }

    public function updateExchangeRate($usdToFcRate) {
        $fcToUsdRate = 1 / floatval($usdToFcRate);
        $this->set('usd_to_fc_rate', $usdToFcRate, 'Taux de change USD vers Franc Congolais');
        $this->set('fc_to_usd_rate', number_format($fcToUsdRate, 18), 'Taux de change Franc Congolais vers USD (calculé automatiquement)');
        return true;
    }
}
?>