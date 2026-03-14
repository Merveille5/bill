<?php ob_clean(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Bill</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-cog mr-2"></i>Panneau d'Administration
                </h1>
            </div>

            <?php if (!empty($message)): ?>
                <div class="mb-4 p-4 rounded <?php echo strpos($message, 'succès') !== false ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Configuration des Taux de Change</h2>
                <form method="POST" action="/admin/dashboard" class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-4">
                        <label for="usd_to_fc_rate" class="block text-sm font-medium text-gray-700 mb-2">
                            Taux USD vers FC (1 USD = ? FC)
                        </label>
                        <input type="number" step="0.01" name="usd_to_fc_rate" id="usd_to_fc_rate"
                               value="<?php echo htmlspecialchars($this->configModel->get('usd_to_fc_rate')); ?>"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <p class="text-sm text-gray-500 mt-1">Actuellement: 1 USD = <?php echo htmlspecialchars($this->configModel->get('usd_to_fc_rate')); ?> FC</p>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-save mr-2"></i>Mettre à jour le taux
                    </button>
                </form>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Toutes les Configurations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 border-b text-left">Clé</th>
                                <th class="px-4 py-2 border-b text-left">Valeur</th>
                                <th class="px-4 py-2 border-b text-left">Description</th>
                                <th class="px-4 py-2 border-b text-left">Dernière MAJ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($configs as $config): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b font-mono text-sm"><?php echo htmlspecialchars($config['key_name']); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($config['value']); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($config['description'] ?? '-'); ?></td>
                                    <td class="px-4 py-2 border-b text-sm"><?php echo htmlspecialchars($config['updated_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    <i class="fas fa-home mr-2"></i>Retour à l'accueil
                </a>
                <a href="/agent/dashboard" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-user-shield mr-2"></i>Panel Agent
                </a>
            </div>
        </div>
    </div>
</body>
</html>