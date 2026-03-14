<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 p-6">
    <h1 class="text-xl font-bold mb-4">Journal des actions</h1>
    <?php if (empty($logs)): ?>
        <p>Aucun log disponible.</p>
    <?php else: ?>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($logs as $l): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border"><?php echo htmlspecialchars($l['created_at']); ?></td>
                    <td class="p-2 border"><?php echo htmlspecialchars($l['action']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <p class="mt-4"><a href="/dashboard" class="text-blue-600 hover:underline">Retour au tableau de bord</a></p>
</body>
</html>