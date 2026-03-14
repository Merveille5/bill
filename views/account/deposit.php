<?php ob_clean(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Dépôt</title>
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
            <div class="px-4 py-2 bg-green-100 text-green-800 mb-4 rounded">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <p>Solde actuel : <strong><?php echo number_format($user['balance'], 2); ?> FC</strong></p>

        <form action="/deposit" method="post" class="mb-6">
            <label for="currency">Devise :</label>
            <select name="currency" id="currency" class="border px-2 py-1 mr-2" required>
                <option value="FC">FC (Franc Congolais)</option>
                <option value="USD">USD</option>
                <option value="USDT">USDT</option>
            </select>
            <label for="amount">Montant :</label>
            <input type="number" step="0.01" name="amount" id="amount" class="border px-2 py-1" required>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Envoyer</button>
        </form>

        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold pb-1">Dépôt</h2>
            <div class="bg-gradient-to-r from-green-300 to-green-500 h-px mb-6"></div>
            <p>Sélectionnez votre opérateur mobile pour recharger votre solde:</p>
            <br>
            <div class="flex flex-row w-full space-x-6">
                <a href="https://apps.apple.com/us/app/my-airtel-africa/id1462268018" target="_blank" class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 transition">
                    <img src="/airtel_logo.webp" alt="airtel" class="w-16 h-16 mr-3">
                    <span class="text-gray-700 font-semibold">Airtel</span>
                </a>
                <a href="https://apps.apple.com/fr/app/orange-max-it-rdc/id6447896435" target="_blank" class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 transition">
                    <img src="/orangemoney.webp" alt="orange" class="w-16 h-16 mr-3">
                    <span class="text-gray-700 font-semibold">Orange</span>
                </a>
                <a href="https://apps.apple.com/fr/app/m-pesa-drc/id1668805076" target="_blank" class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 transition">
                    <img src="/vodacom_logo.webp" alt="Mpesa" class="w-16 h-16 mr-3">
                    <span class="text-gray-700 font-semibold">Vodacom</span>
                </a>
                <a href="https://apps.apple.com/fr/app/africell-drc/id1668805076" target="_blank" class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 transition">
                    <img src="/afrimoney.webp" alt="AfriMoney" class="w-16 h-16 mr-3">
                    <span class="text-gray-700 font-semibold">Africell</span>
                </a>
            </div>
    </div>
</body>
</html>