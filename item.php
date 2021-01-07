<?php
include "./config/config.php";

$id = (int)$_GET['id'];

$result = mysqli_query($link, "UPDATE `products` SET `likes` = `likes` + 1  WHERE id = {$id}");
$result = mysqli_query($link, "SELECT `name`, `image`, `full_descr`, `price` FROM `products` WHERE id = {$id}");

$message = '';

if ($result->num_rows !=0) $item = mysqli_fetch_assoc($result);
else $message = "Данного товара нет в базе...";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <title>Document</title>
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<div class="product_description">
    <? if (empty($message)): ?>
        <b><?=$item['name']?></b>
        <img src="<?=PRODUCTIMG . $item['image'];?>" alt="" style="max-width: 75%">
        <p><?=$item['full_descr']?></p>
        <b>Цена: <?=$item['price']?> руб.</b>
    <? else: ?>
        <div style="color: red"><?=$message?></div>
    <? endif; ?>
</div>
</body>
</html>
