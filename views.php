<?php
include "./config/config.php";

$id = (int)$_GET['id'];
$result = mysqli_query($link, "UPDATE `images` SET `likes` = `likes` + 1  WHERE id = {$id}");
$result = mysqli_query($link, "SELECT * FROM `images` WHERE id = {$id}");

$image = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
    <a href="gallery.php">Вернуться в галлерею</a>
    <div>
        <img src="<?=BIGIMG . $image['name'];?>" alt="" style="max-width: 75%">
    </div>
</body>
</html>
