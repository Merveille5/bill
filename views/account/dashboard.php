<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BILLP2P - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
<body class="bg-gray-200">
    <!-- Navigation Bar -->
    <nav class="bg-green-900 border-b border-gray-300 sticky top-0 z-50">
        <div class="flex justify-between items-center px-9 py-4">
            <!-- Menu Button for Mobile -->
            <button id="menuBtn" class="lg:hidden text-green-500 text-xl">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Logo/Title -->
            <div class="text-white font-bold text-2xl">
                BILLP2P
            </div>

            <!-- User Info & Logout -->
            <div class="flex items-center space-x-6">
                <span class="text-white text-sm hidden sm:inline">
                    <i class="fas fa-user text-green-400 mr-2"></i><?php echo htmlspecialchars($user['username']); ?>
                </span>
                <a href="/logout" class="text-red-400 hover:text-red-300 font-semibold text-sm">
                    <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div id="sideNav" class="hidden lg:block lg:fixed lg:left-0 lg:top-0 lg:w-64 lg:h-screen lg:pt-20 bg-white shadow-lg overflow-y-auto">
        <div class="p-6 space-y-3 pb-20">
            <a href="/dashboard" class="block px-4 py-3 rounded-lg text-white bg-gradient-to-r from-green-900 to-green-400 font-medium hover:shadow-lg transition">
                <i class="fas fa-home mr-3"></i>Accueil
            </a>
            <a href="/account" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-user mr-3"></i>Mon compte
            </a>
            <a href="/logs" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-file-alt mr-3"></i>Logs d'activité
            </a>
            <hr class="my-3">
            <a href="/deposit" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-green-50 transition">
                <i class="fas fa-plus-circle text-green-600 mr-3"></i>Effectuer un dépôt
            </a>
            <a href="/withdraw" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-red-50 transition">
                <i class="fas fa-minus-circle text-red-600 mr-3"></i>Effectuer un retrait
            </a>
            <a href="/convert" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 transition">
                <i class="fas fa-exchange-alt text-blue-600 mr-3"></i>Convertir en USDT
            </a>
            <hr class="my-3">
            <a href="/agent/dashboard" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-purple-50 transition">
                <i class="fas fa-user-shield text-purple-600 mr-3"></i>Panel Agent (Demo)
            </a>
            <hr class="my-3">
            <a href="/admin/dashboard" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-orange-50 transition">
                <i class="fas fa-cog text-orange-600 mr-3"></i>Administration (Demo)
            </a>
            <hr class="my-3">
            <a href="/logout" class="block px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 font-semibold transition">
                <i class="fas fa-sign-out-alt mr-3"></i>Déconnexion
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64 p-4 lg:p-8">
        <!-- Balance Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Solde Fc -->
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">SOLDE FC</p>
                        <h2 class="text-4xl font-bold text-green-600"><?php echo number_format($user['balance'], 2); ?></h2>
                        <p class="text-gray-400 text-xs mt-2">Franc congolais</p>
                    </div>
                    <i class="fas fa-wallet text-green-500 text-3xl opacity-20"></i>
                </div>
            </div>

            <!-- Solde USDT -->
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-2">SOLDE USDT</p>
                        <h2 class="text-4xl font-bold text-blue-600"><?php echo number_format($user['usdt_balance'], 4); ?></h2>
                        <p class="text-gray-400 text-xs mt-2">Tether (USD Coin)</p>
                    </div>
                    <i class="fas fa-coins text-blue-500 text-3xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <!-- Dépôt -->
            <a href="/deposit" class="bg-gradient-to-br from-green-900 to-green-500 p-6 rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 text-white text-center">
                <i class="fas fa-hand-holding-usd text-4xl mb-3 block"></i>
                <p class="font-semibold">Dépôt</p>
                <span class="text-xs text-green-100 block mt-1">Recharger votre solde</span>
            </a>

            <!-- Retrait -->
            <a href="/withdraw" class="bg-gradient-to-br from-red-900 to-red-500 p-6 rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 text-white text-center">
                <i class="fas fa-money-bill-wave text-4xl mb-3 block"></i>
                <p class="font-semibold">Retrait</p>
                <span class="text-xs text-red-100 block mt-1">Retirer votre argent</span>
            </a>

            <!-- Convertir -->
            <a href="/convert" class="bg-gradient-to-br from-blue-900 to-blue-500 p-6 rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 text-white text-center">
                <i class="fas fa-exchange-alt text-4xl mb-3 block"></i>
                <p class="font-semibold">Convertir</p>
                <span class="text-xs text-blue-100 block mt-1">Fc vers USDT</span>
            </a>

            <!-- Historique -->
            <a href="/logs" class="bg-gradient-to-br from-gray-800 to-gray-600 p-6 rounded-lg shadow-md hover:shadow-xl transition transform hover:scale-105 text-white text-center">
                <i class="fas fa-history text-4xl mb-3 block"></i>
                <p class="font-semibold">Historique</p>
                <span class="text-xs text-gray-100 block mt-1">Tous vos logs</span>
            </a>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-history text-green-600 mr-3"></i>Historique des opérations
                </h2>
            </div>

            <?php if (empty($transactions)): ?>
                <div class="p-6 text-center">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4 block"></i>
                    <p class="text-gray-500">Aucune opération pour le moment.</p>
                    <p class="text-gray-400 text-sm mt-2">Effectuez un dépôt, retrait ou conversion pour commencer.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Type</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Devise</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $t):
                                $typeColor = $t['type'] === 'deposit' ? 'bg-green-100 text-green-800' : ($t['type'] === 'withdrawal' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800');
                                $typeIcon = $t['type'] === 'deposit' ? 'arrow-down' : ($t['type'] === 'withdrawal' ? 'arrow-up' : 'exchange-alt');
                                $typeLabel = $t['type'] === 'deposit' ? 'Dépôt' : ($t['type'] === 'withdrawal' ? 'Retrait' : 'Conversion');
                            ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars(substr($t['created_at'], 0, 10)); ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo $typeColor; ?>">
                                            <i class="fas fa-<?php echo $typeIcon; ?> mr-1"></i><?php echo $typeLabel; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right font-bold text-gray-800"><?php echo number_format($t['amount'], 2); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars($t['currency']); ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 rounded text-xs font-medium
                                            <?php echo $t['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : ($t['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo $t['status'] === 'confirmed' ? 'Confirmé' : ($t['status'] === 'pending' ? 'En attente' : 'Annulé'); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo htmlspecialchars($t['agent_name'] ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuBtn').addEventListener('click', function() {
            const sideNav = document.getElementById('sideNav');
            sideNav.classList.toggle('hidden');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sideNav = document.getElementById('sideNav');
            const menuBtn = document.getElementById('menuBtn');
            if (!sideNav.contains(event.target) && !menuBtn.contains(event.target)) {
                if (!menuBtn.classList.contains('hidden')) {
                    sideNav.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>