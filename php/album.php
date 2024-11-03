<?php
session_start();
require_once 'components/header.php';

$albumId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$albumsData = file_get_contents('../json/albums.json');
$albums = json_decode($albumsData, true);

$album = null;
foreach ($albums as $a) {
    if ($a['id'] === $albumId) {
        $album = $a;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'components/head.php'; ?>
<script src="../scripts/howler.js" defer></script>

<link rel="stylesheet" href="../css/range.css">
<link rel="stylesheet" href="../css/spin.css">
<title><?php echo $album['nombre']; ?> - Detalles del Álbum</title>
<body class="bg-gray-800 text-white">

        <div class="flex flex-col items-center">
            <div class="flex items-center p-4">
                <img src="<?php echo $album['logo']; ?>" alt="<?php echo $album['nombre']; ?>" class="w-32 h-32 object-cover rounded-lg mr-4">
                <div>
                    <h1 class="text-3xl font-bold"><?php echo $album['nombre']; ?></h1>
                    <p class="text-gray-400"><?php echo $album['año']; ?></p>
                </div>
            </div>

            <div class="flex flex-col mb-4 w-full border-t border-gray-600">
                <?php foreach ($album['canciones'] as $cancion): ?>
                    <div class="flex items-center bg-gray-900 p-4 w-full border-gray-600 border-b">
                        <img src="<?php echo $album['logo']; ?>" alt="<?php echo $album['nombre']; ?>" class="w-16 h-16 object-cover rounded-lg mr-4" id="logo">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold"><?php echo $cancion['title']; ?></h3>
                            <p class="text-gray-400"><?php echo $cancion['year']; ?></p>
                        </div>
                        <img src="../media/util/unfav.png" class="w-5 h-5 invert fav">
                        <button class="font-bold py-2 px-4 rounded play-button" data-url="<?php echo $cancion['source']; ?>" data-logo="<?php echo $cancion['logo']; ?>" data-name="<?php echo $cancion['title']; ?>" id="<?php echo $cancion["id"]?>"><img src="../media/util/play.png" class="invert" style="height: 25px;"></button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

</body>
</html>
