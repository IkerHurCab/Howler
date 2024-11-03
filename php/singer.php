<?php
session_start();
require_once 'components/header.php';

$singerId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$singersData = file_get_contents('../json/singers.json');
$singers = json_decode($singersData, true);

$singer = null;
foreach ($singers as $s) {
    if ($s['id'] === $singerId) {
        $singer = $s;
        break;
    }
}

$albumsData = file_get_contents('../json/albums.json');
$albums = json_decode($albumsData, true);

$singerAlbums = array_filter($albums, function($album) use ($singerId) {
    return $album['singer_id'] === $singerId; 
});

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'components/head.php'; ?>
<title><?php echo $singer["name"]?> - Radio Taxonera</title>
<body class="bg-gray-800 text-white">
    <?php require_once 'components/header.php'; ?>
    <div class="flex flex-col bg-gray-900 m-4 rounded-xl p-4 items-center">
        <img src="<?php echo $singer['logo']; ?>" alt="<?php echo $singer['name']; ?>" class="w-72 h-72 rounded-full shadow-lg object-cover">

        <div class="text-center m-2">
            <h1 class="text-4xl font-bold"><?php echo $singer['name']; ?></h1>
            <p class="text-lg mt-2"><b>Edad:</b> <?php echo $singer['age']; ?></p>
            <p class="text-lg"><b>Género:</b> <?php echo $singer['genre']; ?></p>
            <p class="mt-4 text-lg text-gray-400">
            <?php echo $singer['description']; ?></p>
        </div><br>
        <h2 class="text-3xl font-bold mb-4">Álbumes</h2>
        <div class="flex flex-col gap-4 mb-4 w-full">
    <?php foreach ($singerAlbums as $album): ?>
        <a href="album.php?id=<?php echo $album['id']; ?>">
            <div class="flex bg-gray-800 rounded-lg p-4 w-full">
                <img src="<?php echo $album['logo']; ?>" alt="<?php echo $album['nombre']; ?>" class="w-32 h-32 object-cover rounded-lg mr-4">
                
                <div class="flex items-center justify-between w-full mx-4">
                    <h3 class="text-xl font-semibold"><?php echo $album['nombre']; ?></h3>
                    <p class="text-gray-400"><?php echo $album['año']; ?></p>
                </div>
            </div>
        </a>

    <?php endforeach; ?>
</div>


    </div>
</body>
</html>
