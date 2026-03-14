<?php
session_start();
require_once 'bd.php';

// redirect if not connected
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
$userId = $_SESSION['user_id'];

// handle deposit
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'], $_POST['operator'])) {
    $amount = floatval($_POST['amount']);
    $operator = $_POST['operator'];
    if ($amount > 0 && in_array($operator, ['m-pesa','orange-money','airtel-money','afri-money'])) {
        $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $stmt->execute([$amount, $userId]);

        // insert into transactions including operator
        $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount, operator) VALUES (?, 'deposit', ?, ?)");
        $stmt->execute([$userId, $amount, $operator]);

        // log action
        $log = $pdo->prepare('INSERT INTO logs (user_id, action) VALUES (?, ?)');
        $log->execute([$userId, "deposit $amount via $operator"]);

        $message = 'Dépôt effectué avec succès.';
    } else {
        $message = 'Le montant doit être positif et l\'opérateur valide.';
    }
}

// fetch current balance
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
    <title>Dépôt</title>
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
     <!-- Contenu des opérations-->

<?php if (
    isset($message) && $message !== ''): ?>
    <div class="px-4 py-2 bg-green-100 text-green-800 mb-4 rounded">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<p>Solde actuel : <strong><?php echo number_format($balance,2); ?> Fc</strong></p>

<form method="post" class="mb-6">
    <label for="operator">Opérateur :</label>
    <select name="operator" id="operator" class="border px-2 py-1 mr-2" required>
        <option value="">-- choisir --</option>
        <option value="m-pesa">M-Pesa</option>
        <option value="orange-money">Orange Money</option>
        <option value="airtel-money">Airtel Money</option>
        <option value="afri-money">Afri-money</option>
    </select>
    <label for="amount">Montant :</label>
    <input type="number" step="0.01" name="amount" id="amount" class="border px-2 py-1" required>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Envoyer</button>
</form>

            <div class="mt-8 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
                <!-- Premier conteneur -->
                 <div class="mt-8 flex flex-col space-x-4">  <!-- Premier conteneur --> 

                 </div>
                <!-- bloc dépôt-->
                <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                    <h2 class="text-black-500 text-lg font-semibold pb-1">Dépôt</h2>
                    <div class="my-1"></div> <!-- Espace de separation -->
                    <div class="bg-gradient-to-r from-green-300 to-green-500 h-px mb-6"></div> <!-- Ligne de séparation -->
            
                            
                   

                    <br>
                    <p>Sélectionnez votre opérateur mobile pour recharger votre solde:</p>
                    <br>
                     <!--operateurs-->
                       <div class="flex flex-row w-full space-x-6">

                        <!--airtel-->

                          <a href="https://apps.apple.com/us/app/my-airtel-africa/id1462268018?utm_source=chatgpt.com" target="_blanck"
                            class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 items-center justify-center hover:bg-green-50  transition">
                            <img src="airtel.png" alt="airtel" class="w-16 h-16 mr-3">
                            <span class="text-gray-700 font-semibold">airtel</span>
                          </a>
                         <!--orange-->
                          <a href="https://apps.apple.com/fr/app/orange-max-it-rdc/id6447896435?utm_source=chatgpt.com" target="_blanck"
                           class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 items-center justify-center hover:bg-green-50  transition">
                            <img src="orangem.png" alt="orange" class="w-16 h-16">
                            <span class="text-gray-700 font-semibold">Orange</span>
                          </a>
                           <!--vodacom-->
                           <a href="https://apps.apple.com/fr/app/m-pesa-drc/id1668805076?utm_source=chatgpt.com" target="_blanck"
                            class="border border-gray-300 rounded p-6 flex items-center hover:bg-green-50 items-center justify-center hover:bg-green-50 transition">
                            <img src="Mpesa-logo.png" alt="Mpesa" class="w-16 h-16">
                            <span class="text-gray-700 font-semibold">Vodacom</span>
                           </a>
                         
                    </div>
                    
                </div>
</body>
</html>