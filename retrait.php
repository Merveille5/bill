<?php
session_start();
require_once 'bd.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
$userId = $_SESSION['user_id'];

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount = floatval($_POST['amount']);
    if ($amount > 0) {
        // check balance
        $stmt = $pdo->prepare('SELECT balance FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $current = $stmt->fetchColumn();
        if ($current >= $amount) {
            $stmt = $pdo->prepare('UPDATE users SET balance = balance - ? WHERE id = ?');
            $stmt->execute([$amount, $userId]);
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount) VALUES (?, 'withdrawal', ?)");
            $stmt->execute([$userId, $amount]);
            // log
            $log = $pdo->prepare('INSERT INTO logs (user_id, action) VALUES (?, ?)');
            $log->execute([$userId, "withdrawal $amount"]);
            $message = 'Retrait effectué.';
        } else {
            $message = 'Solde insuffisant.';
        }
    } else {
        $message = 'Le montant doit être positif.';
    }
}

$stmt = $pdo->prepare('SELECT balance FROM users WHERE id = ?');
$stmt->execute([$userId]);
$balance = $stmt->fetchColumn();
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
    <title>Retrait</title>
</head>
<body class="bg-gray-200">

    <nav class="bg-green-900 border-b border-gray-300">
        <div class="flex justify-between items-center px-9">
            <!-- Aumenté el padding aquí para añadir espacio en los lados -->

            <!-- icone de menu -->
            <button id="menuBtn">
                <i class="fas fa-bars text-green-500 text-lg"></i>
            </button>

            <!-- Logo -->
            <div class="ml-1">
                <img src="logo.png" alt="logo" class="h-20 w-28">
                
            </div>

            <!-- icone de notif -->
            <div class="space-x-4">
                <button>
                    <i class="fas fa-bell text-green-500 text-lg"></i>
                </button>

                <!-- Buton de profil-->
                <button>
                    <i class="fas fa-user text-green-500 text-lg"></i>
                </button>
            </div>
        </div>
    </nav>

<?php if (isset($message) && $message !== ''): ?>
    <div class="px-4 py-2 mb-4 <?php echo strpos($message,'insuffisant')!==false ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'; ?> rounded">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<p>Solde actuel : <strong><?php echo number_format($balance,2); ?> Fc</strong></p>
<form method="post" class="mb-6">
    <label for="amount">Montant à retirer :</label>
    <input type="number" step="0.01" name="amount" id="amount" class="border px-2 py-1" required>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Retirer</button>
</form>

</body>
</html>