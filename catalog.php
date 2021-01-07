<?php
//session_start();
include "./config/config.php";

$result = mysqli_query($link, "SELECT * FROM products ORDER BY likes DESC");

if ($_GET['action'] == 'buy') {
    $session = session_id();
    unset($_SESSION['message']);
    $id = (int)$_GET['id'];
    mysqli_query($link, "INSERT INTO cart(product_id, session_id) VALUES ('{$id}', '{$session}')");
    header("Location: /catalog.php");
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<div class="container">
    <div class="gallery">
        <? if ($result): ?>
            <?php foreach($result as $item):  ?>
                <div class="item">
                    <a href="item.php?id=<?=$item['id']?>"><img src="<?=PRODUCTIMG . $item['image'];?>" alt=""></a>
                    <span>Описание: <?=$item['descr']?></span><br>
                    <span>Цена: <?=$item['price']?></span><br>
                    <span>Количество просмотров: <?=$item['likes']?></span><br>
                    <a href="?action=buy&id=<?=$item['id']?>"><button>В корзину</button></a><br>
                </div>
            <?php endforeach; ?>
        <? else: ?>
            В каталоге пока нет товаров...
        <? endif; ?>
    </div>
</div>
</body>
</html>
