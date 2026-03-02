<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">


    <title>Document</title>
</head>
<body>
    <!-- component -->
<!-- This is an example component -->
   
<div class="bg-white-200 flex">
  <div class="flex-col flex ml-auto mr-auto items-center w-full lg:w-2/3 md:w-3/5">
    <h1 class="font-bold text-2xl my-10 text-black"> Welcome to BILLP2P </h1>
 <form action="" class="mt-2 flex flex-col lg:w-1/2 w-8/12">
          <div class="flex flex-wrap items-stretch w-full mb-4 relative h-15 bg-white items-center rounded mb-6 pr-10">
            <div class="flex -mr-px justify-center w-15 p-4">
              <span
                class="flex items-center leading-normal bg-white px-3 border-0 rounded rounded-r-none text-2xl text-gray-600"
              >
                <i class="fas fa-user-circle"></i>
              </span>
            </div>
            <input
              type="text"
             class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 h-10 border border-gray-400 rounded rounded-l-none px-3 self-center relative font-roboto text-xl outline-none"
              placeholder="Nom d'utilisateur"
            />
          </div>
          <div class="flex flex-wrap items-stretch w-full relative h-15 bg-white items-center rounded mb-4">
            <div class="flex -mr-px justify-center w-15 p-4">
              <span
                class="flex items-center leading-normal bg-white rounded rounded-r-none text-xl px-3 whitespace-no-wrap text-gray-600"
                > 
                <i class="fas fa-lock"></i>
                  </span
              >
            </div>
            <input
              type="password"
             class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 h-10 border border-gray-400 rounded rounded-l-none px-3 self-center relative font-roboto text-xl outline-none"
              placeholder="mot de passe"
             />
            <div class="flex -mr-px">
              <span
                class="flex items-center leading-normal bg-white rounded rounded-l-none border-0 px-3 whitespace-no-wrap text-gray-600"
                >
                <i class="fas fa-eye-slash"></i>
                </span>
            </div>
          </div>
          <a href="#" class="text-base text-black text-right font-roboto leading-normal hover:underline mb-6">Mot de passe oublié ?</a>
          <a
          href="acceuil.php"
            class="bg-[#006400] py-4 text-center px-17 md:px-12 md:py-4 text-white rounded leading-tight text-xl md:text-base font-sans mt-4 mb-20">

          >
            Connexion
        </a>
        </form>
</div>















</div>
</body>
</html>