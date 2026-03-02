<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
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
</body>
</html>