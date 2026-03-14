<?php ob_clean(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl mb-4">Créer un compte</h1>
        <?php if ($message): ?>
            <p class="text-red-500 mb-4"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="/register" method="post" class="space-y-4">
            <div>
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="w-full border px-2 py-1" required>
            </div>
            <div>
                <label>Mot de passe</label>
                <input type="password" name="password" class="w-full border px-2 py-1" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">S'inscrire</button>
        </form>
        <p class="mt-4">Déjà membre ? <a href="/login" class="text-blue-600">Se connecter</a></p>
    </div>
</body>
</html>