<!DOCTYPE html>
<html lang="fr">
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
            <button id="menuBtn">
                <i class="fas fa-bars text-green-500 text-lg"></i>
            </button>
            <div class="text-white font-bold text-2xl">BILLP2P</div>
            <div class="space-x-4">
                <a href="/dashboard" class="text-white">Accueil</a>
                <a href="/logout" class="text-red-400">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <?php if (isset($message) && $message !== ''): ?>
            <div class="px-4 py-2 mb-4 <?php echo strpos($message,'insuffisant')!==false ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'; ?> rounded">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <p>Solde actuel : <strong><?php echo number_format($user['balance'], 2); ?> FC</strong></p>
        <p>Solde USDT : <strong><?php echo number_format($user['usdt_balance'], 4); ?> USDT</strong></p>

        <form action="/withdraw" method="post" class="mb-6">
            <label for="currency">Devise :</label>
            <select name="currency" id="currency" class="border px-2 py-1 mr-2" required>
                <option value="FC">FC (Franc Congolais)</option>
                <option value="USD">USD</option>
                <option value="USDT">USDT</option>
            </select>
            <label for="amount">Montant à retirer :</label>
            <input type="number" step="0.01" name="amount" id="amount" class="border px-2 py-1" required>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Retirer</button>
        </form>
    </div>
</body>
</html>