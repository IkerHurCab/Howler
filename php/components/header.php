<script src="../scripts/borgesa.js" defer></script>
<header class="flex items-center justify-between p-4 bg-black border-b-2 border-white">
        <a href="main.php"><img src="../media/util/logo.png" alt="Logo Radio Taxonera" class="h-16 w-auto invert"></a>

        <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">

            <svg class="w-6 h-6 hover:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <nav class="hidden lg:block">
            <ul class="flex space-x-6">
                <li><a href="./main.php" class="hover:text-blue-300">Inicio</a></li>
                <li><a href="./radios.php" class="hover:text-blue-300">Radios</a></li>
            </ul>
        </nav>


    </header>
        <div class="bg-gray-700 border-t border-gray-600 text-center overflow-hidden transition-all duration-300 ease-in-out max-h-0 lg:hidden"
             id="mobile-menu">
            <nav>
                <ul class="flex flex-col">
                    <li class="py-2 border-b-2 border-gray-600"><a href="./main.php" class="hover:text-blue-300">Inicio</a></li>
                    <li class="py-2 border-b-2 border-gray-600"><a href="./radios.php" class="hover:text-blue-300">Radios</a></li>
                </ul>
            </nav>
        </div>