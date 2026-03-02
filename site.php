<!-- component -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BILLP2P</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

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

    <!-- Barra lateral -->
    <div id="sideNav" class="lg:block hidden bg-white w-64 h-screen fixed rounded-none border-none">
        <!-- Items -->
        <div class="p-4 space-y-4">
            <!-- acceuil -->
            <a href="#" aria-label="dashboard"
                class="relative px-4 py-3 flex items-center space-x-4 rounded-lg text-white bg-gradient-to-r from-green-900 to-green-400">
                <i class="fas fa-home text-white"></i>
                <span class="-mr-1 font-medium">Acceuil</span>
            </a>

            <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                <i class="fas fa-wallet"></i>
                <span>Solde</span>
            </a>
            <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                <i class="fas fa-exchange-alt"></i>
                <span>Transactions</span>
            </a>
            <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                <i class="fas fa-user"></i>
                <span>Mon compte</span>
            </a>
            <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                <i class="fas fa-sign-out-alt"></i>
                <span>Créer un nouveau compte</span>
            </a>
        </div>
    </div>

    <div class="lg:ml-64 lg:pl-4 lg:flex lg:flex-col lg:w-75% mt-5 mx-2">

        <!-- Barre de recherche -->
        <div class="bg-white rounded-full border-none p-3 mb-4 shadow-md">
            <div class="flex items-center">
                <i class="px-3 fas fa-search ml-1"></i>
                <input type="text" placeholder="Entrez votre recherche" class="ml-3 focus:outline-none w-full">
            </div>
        </div>

        <!-- Conteneur principal-->
        <div class="lg:flex gap-4 items-stretch">
            <!-- solde -->
            <div class="bg-white md:p-2 p-6 rounded-lg border border-gray-200 mb-4 lg:mb-0 shadow-md lg:w-[35%]">
                <div class="flex justify-center items-center space-x-5 h-full">
                    <div>
                        <p>Solde actuel</p>
                        <h2 class="text-4xl font-bold text-gray-600">50.365</h2>
                       
                    </div>
                </div>
            </div>

            <!-- Caja Blanca -->
            <div class="bg-white p-4 rounded-lg xs:mb-4 max-w-full shadow-md lg:w-[65%]">
                <!-- Cajas pequeñas -->
                <div class="flex flex-wrap justify-between h-full">
                    <!-- Caja pequeña 1 -->
                    <div
                        class="flex-1 bg-gradient-to-r from-green-900 to-green-400 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                        <i class="fas fa-hand-holding-usd text-white text-4xl"></i>
                        <p class="text-white">Dépôt</p>
                    </div>

                    <!-- Caja pequeña 2 -->
                    <div
                        class="flex-1 bg-gradient-to-r from-green-900 to-green-400 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                        <i class="fas fa-exchange-alt text-white text-4xl"></i>
                        <p class="text-white">Retrait</p>
                    </div>

                    <!-- Caja pequeña 3 -->
                    <div
                        class="flex-1 bg-gradient-to-r from-cyan-400 to-cyan-600 rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
                        <i class="fas fa-qrcode text-white text-4xl"></i>
                        <p class="text-white">Canjear</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- tableau -->
        <!-- component -->
<!-- component -->
<div class="max-w-[720px] mx-auto">
    
     <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]">
        <a target='_blank' href='https://www.material-tailwind.com/docs/html/table' class='block w-full px-4 py-2 text-center text-slate-700 transition-all '>
                More components on <b>Material Tailwind</b>.
            </a>
    </div>

    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">Projects with Invoices</h3>
            <p class="text-slate-500">Overview of the current activities.</p>
        </div>
        <div class="ml-3">
            <div class="w-full max-w-sm min-w-[200px] relative">
            <div class="relative">
                <input
                class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                placeholder="Search for invoice..."
                />
                <button
                class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
                type="button"
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                </button>
            </div>
            </div>
        </div>
    </div>
    
    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
        <tr>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-normal leading-none text-slate-500">
                Invoice Number
            </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-normal leading-none text-slate-500">
                Customer
            </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-normal leading-none text-slate-500">
                Amount
            </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-normal leading-none text-slate-500">
                Issued
            </p>
            </th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">
            <p class="text-sm font-normal leading-none text-slate-500">
                Due Date
            </p>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="hover:bg-slate-50 border-b border-slate-200">
            <td class="p-4 py-5">
            <p class="block font-semibold text-sm text-slate-800">PROJ1001</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">John Doe</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">$1,200.00</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-01</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-15</p>
            </td>
        </tr>
        <tr class="hover:bg-slate-50 border-b border-slate-200">
            <td class="p-4 py-5">
            <p class="block font-semibold text-sm text-slate-800">PROJ1002</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">Jane Smith</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">$850.00</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-05</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-20</p>
            </td>
        </tr>
        <tr class="hover:bg-slate-50 border-b border-slate-200">
            <td class="p-4 py-5">
            <p class="block font-semibold text-sm text-slate-800">PROJ1003</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">Acme Corp</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">$2,500.00</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-07</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-21</p>
            </td>
        </tr>
        <tr class="hover:bg-slate-50 border-b border-slate-200">
            <td class="p-4 py-5">
            <p class="block font-semibold text-sm text-slate-800">PROJ1004</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">Global Inc</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">$4,750.00</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-10</p>
            </td>
            <td class="p-4 py-5">
            <p class="text-sm text-slate-500">2024-08-25</p>
            </td>
        </tr>
        </tbody>
    </table>
    
    <div class="flex justify-between items-center px-4 py-3">
        <div class="text-sm text-slate-500">
        Showing <b>1-5</b> of 45
        </div>
        <div class="flex space-x-1">
        <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            Prev
        </button>
        <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-slate-800 border border-slate-800 rounded hover:bg-slate-600 hover:border-slate-600 transition duration-200 ease">
            1
        </button>
        <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            2
        </button>
        <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            3
        </button>
        <button class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            Next
        </button>
        </div>
    </div>
    </div>
    
        
 



</div>


    <!-- Script  -->
    <script>

        // Agregar lógica para mostrar/ocultar la navegación lateral al hacer clic en el ícono de menú
        const menuBtn = document.getElementById('menuBtn');
        const sideNav = document.getElementById('sideNav');

        menuBtn.addEventListener('click', () => {
            sideNav.classList.toggle('hidden');
        });
    </script>
</body>

</html>