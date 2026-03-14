<?php
session_start();
require_once 'bd.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username && $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        try {
            $stmt->execute([$username, $hash]);
            $newId = $pdo->lastInsertId();
            // log registration
            $log = $pdo->prepare('INSERT INTO logs (user_id, action) VALUES (?, ?)');
            $log->execute([$newId, 'register']);
            header('Location: connexion.php');
            exit;
        } catch (Exception $e) {
            $message = 'Nom d\'utilisateur déjà utilisé';
        }
    } else {
        $message = 'Veuillez remplir tous les champs';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
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
        <form method="post" class="space-y-4">
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
        <p class="mt-4">Déjà membre ? <a href="connexion.php" class="text-blue-600">Se connecter</a></p>
    </div>
</body>
</html>