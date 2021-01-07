<?php
include "./config/config.php";

$result = mysqli_query($link, "SELECT * FROM products AS p JOIN cart AS c ON p.id = c.product_id WHERE c.session_id = '{$session}'");
$cart_items = mysqli_fetch_assoc($result);

switch ($_GET['action']) {
    case 'incr':
        $id = (int)$_GET['id'];
        mysqli_query($link, "UPDATE cart SET qty = qty + 1 WHERE id = '{$id}' AND session_id = '{$session}'");
        header("Location: /cart.php");
        break;
    case 'decr':
        $id = (int)$_GET['id'];
        $result = mysqli_query($link, "SELECT qty FROM cart WHERE id = '{$id}' AND session_id = '{$session}'");
        $row = mysqli_fetch_assoc($result);

        if ($row['qty'] == '0') {
            mysqli_query($link, "DELETE FROM cart WHERE id = '{$id}' AND session_id = '{$session}'");
            header("Location: /cart.php");
            break;
        }
        else {
            mysqli_query($link, "UPDATE cart SET qty = qty - 1 WHERE id = '{$id}' AND session_id = '{$session}'");
            header("Location: /cart.php");
            break;
        }
    case 'del':
        $id = (int)$_GET['id'];
        mysqli_query($link, "DELETE FROM cart WHERE id = '{$id}' AND session_id = '{$session}'");
        header("Location: /cart.php");
        break;
    case 'order':
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['name'])));
        $phone = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['phone'])));
        mysqli_query($link, "INSERT INTO orders (`user_name`, `phone`, `session_id`, `status`) VALUES ('{$name}','{$phone}','{$session}', 'new')");
        session_regenerate_id();
        $_SESSION['message'] = "Заказ оформлен, спасибо!";
        header("Location: /cart.php");
        break;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
//    unset($_SESSION['message']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<?= $message ?><br>
<div class="container">
    <div class="gallery">
        <? if ($cart_items): ?>
            <?php foreach($result as $item):  ?>
                <div class="cart-item">
                    <img src="<?=PRODUCTIMG . $item['image'];?>" alt="">
                    <span>Описание: <?=$item['descr']?></span><br>
                    <span>Цена: <?=$item['price']?></span><br>
                    <span>Количество: <?=$item['qty']?></span><br>
                    <div class="qty">
                        <a href="?action=decr&id=<?=$item['id']?>"><button>-</button></a>
                        <a href="?action=incr&id=<?=$item['id']?>"><button>+</button></a>
                    </div>
                    <span>Сумма: <?=$item['price'] * $item['qty']?> </span>
                    <a href="?action=del&id=<?=$item['id']?>"><button>Удалить</button></a>
                </div>
            <?php endforeach; ?>
        <? else: ?>
        <div class="cart-item">
            <span>В корзине пока нет товаров...</span><br>
        </div>
        <? endif; ?>
            <form action="?action=order" method="post">
                <? if ($auth): ?>
                <input type="text" name="name" value="<?=$name?>" readonly>
                <? else: ?>
                <input type="text" name="name" placeholder="Ваше имя" required>
                <? endif; ?>
                <input type="text" name="phone" placeholder="Телефон" required>
                <input type="submit" value="Оформить">
            </form>
    </div>
</div>
</body>
</html>