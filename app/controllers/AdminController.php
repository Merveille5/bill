<?php
require_once __DIR__ . '/../models/Config.php';

class AdminController {
    private $pdo;
    private $configModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->configModel = new Config($pdo);
    }

    public function dashboard() {
        session_start();
        // For demo, assume admin is logged in
        // In production, you'd have admin authentication

        $configs = $this->configModel->getAll();
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usdToFcRate = $_POST['usd_to_fc_rate'] ?? '';
            if (is_numeric($usdToFcRate) && $usdToFcRate > 0) {
                $this->configModel->updateExchangeRate($usdToFcRate);
                $message = 'Taux de change mis à jour avec succès.';
                $configs = $this->configModel->getAll(); // Refresh data
            } else {
                $message = 'Taux invalide.';
            }
        }

        require_once __DIR__ . '/../../views/admin/dashboard.php';
    }
}
?>