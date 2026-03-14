<?php
session_start();
require_once 'bd.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
$userId = $_SESSION['user_id'];

// fetch user info
$stmt = $pdo->prepare('SELECT username, balance, usdt_balance, created_at FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Mon compte</h1>
        <div class="space-y-3">
            <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Solde Fc :</strong> <?php echo number_format($user['balance'], 2); ?></p>
            <p><strong>Solde USDT :</strong> <?php echo number_format($user['usdt_balance'], 4); ?></p>
            <p><strong>Compte créé :</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>
        <p class="mt-6"><a href="site.php" class="text-blue-600 hover:underline">Retour au dashboard</a></p>
    </div>
</body>
</html>