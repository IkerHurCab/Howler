<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'components/head.php'; ?>
<script src="../scripts/radio.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

<title>Radios - Radio Taxonera</title>
<link rel="stylesheet" href="../css/range.css">
<link rel="stylesheet" href="../css/spin.css">

<body class="bg-gray-900 text-white">

<?php require_once 'components/header.php'; ?>

<div class="container mx-auto p-6">
    <div class="flex flex-col items-center mb-6">
        <h1 class="text-4xl font-bold text-center mb-4">Emisoras de Radio</h1>
        <p class="text-gray-400 text-center">Explora las mejores estaciones y escucha en vivo.</p>
    </div>

    <div id="radios-container" class="flex flex-col gap-6 w-full">
    </div>
</div>

</body>
</html>
