<?php
session_start();
require_once 'bd.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
$userId = $_SESSION['user_id'];

// fixed conversion rate (Fc to USDT)
$rate = 0.0008; // example, 1 Fc = 0.0008 USDT ~ 1250 Fc per USDT

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount = floatval($_POST['amount']);
    if ($amount > 0) {
        // get current Fc balance
        $stmt = $pdo->prepare('SELECT balance, usdt_balance FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $row = $stmt->fetch();
        $current = $row['balance'];
        if ($current >= $amount) {
            $usdt = $amount * $rate;
            // update balances
            $stmt = $pdo->prepare('UPDATE users SET balance = balance - ?, usdt_balance = usdt_balance + ? WHERE id = ?');
            $stmt->execute([$amount, $usdt, $userId]);
            // record conversion transaction
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount, currency) VALUES (?, 'convert', ?, 'USDT')");
            $stmt->execute([$userId, $usdt]);
            // log
            $log = $pdo->prepare('INSERT INTO logs (user_id, action) VALUES (?, ?)');
            $log->execute([$userId, "convert $amount Fc to $usdt USDT"]);
            $message = 'Conversion réussie : ' . number_format($usdt, 4) . ' USDT ajouté.';
        } else {
            $message = 'Solde Fc insuffisant.';
        }
    } else {
        $message = 'Le montant doit être positif.';
    }
}

// fetch balances
$stmt = $pdo->prepare('SELECT balance, usdt_balance FROM users WHERE id = ?');
$stmt->execute([$userId]);
$row = $stmt->fetch();
$balance = $row['balance'];
$usdt = $row['usdt_balance'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Convertir en USDT</title>
</head>
<body class="bg-gray-200">

<nav class="bg-green-900 border-b border-gray-300">
    <div class="flex justify-between items-center px-9">
        <button id="menuBtn">
            <i class="fas fa-bars text-green-500 text-lg"></i>
        </button>
        <div class="ml-1">
            <img src="logo.png" alt="logo" class="h-20 w-28">
        </div>
        <div class="space-x-4">
            <button><i class="fas fa-bell text-green-500 text-lg"></i></button>
            <button><i class="fas fa-user text-green-500 text-lg"></i></button>
        </div>
    </div>
</nav>

<div class="p-6">
    <?php if ($message): ?>
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <p>Solde Fc : <strong><?php echo number_format($balance,2); ?></strong></p>
    <p>Solde USDT : <strong><?php echo number_format($usdt,4); ?></strong></p>

    <form method="post" class="mt-4">
        <label for="amount">Montant Fc à convertir :</label>
        <input type="number" step="0.01" name="amount" id="amount" class="border px-2 py-1" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Convertir</button>
    </form>
</div>

</body>
</html>