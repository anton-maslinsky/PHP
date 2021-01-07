<?php
include "./config/config.php";

$order_id = (int)$_GET['order_id'];

$order_sql = mysqli_query($link, "SELECT * FROM orders WHERE id = '{$order_id}'");
$session_id = mysqli_fetch_assoc($order_sql);

$user_login = mysqli_real_escape_string($link, strip_tags(stripslashes($session_id['user_name'])));

$user_name_sql = mysqli_query($link, "SELECT user_name FROM users WHERE login = '{$user_login}'");
$user_name = mysqli_fetch_assoc($user_name_sql)['user_name'];


$result = mysqli_query($link, "SELECT * FROM products AS p JOIN cart AS c ON p.id = c.product_id WHERE c.session_id = '{$session_id['session_id']}'");

$newOrders_sql = mysqli_query($link, "SELECT * FROM cart WHERE session_id = '{$session_id['session_id']}' AND status = 'new'");
$newOrders = mysqli_fetch_assoc($newOrders_sql);


switch ($_GET['action']) {
    case 'accept':
        $id = (int)$_GET['id'];
        $sql = "UPDATE cart SET status = 'accepted' where id = '{$id}'";
        mysqli_query($link, $sql);
        header("Location: /order.php?&order_id=$order_id&user_name=$user_login");
        break;
    case 'toWork':
        if (empty($newOrders)) {
            $sql = "UPDATE orders SET status = 'accepted' where id = '{$order_id}'";
            mysqli_query($link, $sql);
            header("Location: /order.php?&order_id=$order_id&user_name=$user_login");
            break;
        }
        else {
            $sql = "UPDATE orders SET status = 'not accepted' where id = '{$order_id}'";
            mysqli_query($link, $sql);
            header("Location: /order.php?&order_id=$order_id&user_name=$user_login");
            break;
        }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<div class="container">
    <h3>Подробности заказа</h3>
    <div class="gallery">
        <span>Имя пользователя: <b><?=$user_name?></b></span><br>
        <span>Статус заказа: <b><?=$session_id['status']?></b></span><br>
        <span>Телефон: <b><?=$session_id['phone']?></b></span><br>
            <?php foreach($result as $item):  ?>
                <div class="cart-item">
                    <img src="<?=PRODUCTIMG . $item['image'];?>" alt="">
                    <span>Описание: <?=$item['descr']?></span><br>
                    <span>Цена: <?=$item['price']?></span><br>
                    <span>Количество: <?=$item['qty']?></span><br>
                    <span>Сумма: <?=$item['price'] * $item['qty']?> </span>
                    <span>Статус: <?=$item['status']?></span>
                    <a href="?action=accept&id=<?=$item['id']?>&order_id=<?=$order_id?>&user_name=<?=$order_user_name?>">
                        <? if($item['status'] == 'accepted'): ?>
                            <button>Подтверждён</button>
                        <? else: ?>
                            <button>Подтвердить</button>
                        <? endif;?>
                    </a>
                </div>
            <?php endforeach; ?>
    </div>
    <a class="toWorkBtn" href="?action=toWork&order_id=<?=$order_id?>&user_name=<?=$order_user_name?>">
        <? if($session_id['status'] == 'accepted'): ?>
            <button>В работе</button>
        <? else: ?>
            <button>В работу</button>
        <? endif;?>
    </a>
    <a href="/admin.php">Вернуться к списку заказов</a>

</div>
</body>
</html>
