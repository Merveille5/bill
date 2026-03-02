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
     <!-- Contenu des opérations-->

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