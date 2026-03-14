<?php ob_clean(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Agent - Bill</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-user-shield mr-2"></i>Tableau de Bord Agent
                </h1>
                <div class="text-sm text-gray-600">
                    Agent: <?php echo htmlspecialchars($agent['name']); ?> | Solde USDT: <?php echo number_format($agent['usdt_balance'], 2); ?>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Transactions en Attente</h2>
                <?php if (empty($pendingTransactions)): ?>
                    <p class="text-gray-500">Aucune transaction en attente.</p>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 border-b text-left">ID</th>
                                    <th class="px-4 py-2 border-b text-left">Utilisateur</th>
                                    <th class="px-4 py-2 border-b text-left">Type</th>
                                    <th class="px-4 py-2 border-b text-left">Montant</th>
                                    <th class="px-4 py-2 border-b text-left">Devise</th>
                                    <th class="px-4 py-2 border-b text-left">Date</th>
                                    <th class="px-4 py-2 border-b text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingTransactions as $transaction): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b"><?php echo $transaction['id']; ?></td>
                                        <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($transaction['username']); ?></td>
                                        <td class="px-4 py-2 border-b">
                                            <span class="px-2 py-1 rounded text-xs font-medium
                                                <?php echo $transaction['type'] === 'deposit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                                <?php echo $transaction['type'] === 'deposit' ? 'Dépôt' : 'Retrait'; ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border-b"><?php echo number_format($transaction['amount'], 2); ?></td>
                                        <td class="px-4 py-2 border-b"><?php echo $transaction['currency']; ?></td>
                                        <td class="px-4 py-2 border-b"><?php echo $transaction['created_at']; ?></td>
                                        <td class="px-4 py-2 border-b">
                                            <form method="POST" action="/agent/confirm" class="inline">
                                                <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm mr-1">
                                                    <i class="fas fa-check"></i> Confirmer
                                                </button>
                                            </form>
                                            <form method="POST" action="/agent/cancel" class="inline">
                                                <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                                                    <i class="fas fa-times"></i> Annuler
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center">
                <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-home mr-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</body>
</html>