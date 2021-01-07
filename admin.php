<?php
include "./config/config.php";

$result = mysqli_query($link, "SELECT * FROM orders");
//$result = mysqli_query($link, "SELECT * FROM orders AS o JOIN cart AS c ON o.session_id = c.session_id JOIN products AS p ON c.product_id = p.id WHERE o.status = 'new'");
$newOrders = mysqli_fetch_assoc($result);
//var_dump($newOrders);


?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/styles/style.css">
        <title>Document</title>
    </head>
    <body>
    <?php include TEMPLATES_DIR . "menu.php"?>
    <div class="container">
        <h2>Список заказов</h2>
        <?php if (isAdmin()): ?>
            <?php foreach($result as $item):  ?>
                <div class="order">
                    <span>Статус заказа: <b><?=$item['status']?></b></span>
                    <span>Имя пользователя: <b><?=$item['user_name']?></b></span>
                    <a href="order.php?order_id=<?=$item['id']?>&user_name=<?=$item['user_name']?>"><button>Подробности</button></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    </body>
    </html>