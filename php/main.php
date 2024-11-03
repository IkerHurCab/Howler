<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php 
require_once 'components/head.php';
?>
<title>Inicio - Radio Taxonera</title>
<script src="../scripts/generateSingers.js" defer></script>

<body class="bg-gray-800 text-white">
    <?php require_once 'components/header.php'; ?>
<h1 class="text-5xl font-bold  m-4">
    ¡Bienvenido/a, <?php echo $_SESSION['username'].'!'; ?>
</h1>
<div class="flex h-screen p-4 bg-gray-800">
    <div class="w-1/4 bg-gray-900 text-white p-4 mx-2 rounded-xl">
        <h1 class="text-3xl font-bold text-white mb-4 border-b border-white pb-2 shadow-lg">
            Mi biblioteca
        </h1>
    </div>
    <div class="w-3/4 bg-gray-900 text-white p-4 mx-2 rounded-xl h-full">
    <h1 class="text-3xl font-bold text-white mb-4 border-b border-white pb-2 shadow-lg">
        Artistas populares
    </h1>
    <div id="singers-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 overflow-y-auto max-h-[80vh] p-4">
    </div>
</div>
</div>

</body>
</html>