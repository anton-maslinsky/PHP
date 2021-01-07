<?php

include "./config/config.php";

$action = $_GET['action'];
if ($action == 'delete') {
    $id = (int)$_GET['id'];
    $result = mysqli_query($link, "DELETE FROM `images` WHERE id = {$id}");
    header("location: index.php");
}

$result = mysqli_query($link, "SELECT * FROM `images` ORDER BY `likes` DESC");

$error = "";

$err = [
    'OK' => 'Файл загружен успешно',
    'ERROR' => 'Ошибка загрузки файла'
];

if (!empty($_FILES)) {
    $path = BIGIMG . $_FILES["myfile"]["name"];
    $name = SMALLIMG . $_FILES["myfile"]["name"];

    $imageinfo = getimagesize($_FILES['myfile']['tmp_name']);
    if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' &&
        $imageinfo['mime'] != 'image/png') {
        echo "Sorry, we only accept GIF, PNG and JPEG images\n";
        die();
    }

    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $path)) {
        $img = $_FILES['myfile']['name'];
        mysqli_query($link, "INSERT INTO `images` (`id`, `name`, `likes`) VALUES (NULL, '{$img}', '0');");
        $error = "Файл загружен <br>";
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToWidth(150);
        $image->save($name);

        header("Location: gallery.php?error=OK");
        die();
    } else {
        $error = "Ошибка загрузки файла <br>";
        header("Location: gallery.php?error=ERROR ");
        die();
    }
}

$error = $err[$_GET['error']];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<div class="container">
    <div class="gallery">
        <?php foreach($result as $item):  ?>
            <div class="item">
                <a href="views.php?id=<?=$item['id']?>"><img src="<?=SMALLIMG . $item['name'];?>" alt="" width="150" height="100"></a>
                <a href="?action=delete&id=<?=$item['id']?>">[Удалить]</a>
                <span>Количество просмотров: <?=$item['likes']?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="upload_img">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myfile">
            <input type="submit" value="Load">
        </form>
    </div>
</div>
</body>
</html>
