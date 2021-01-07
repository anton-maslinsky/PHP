<?php
$link = '';
include "./config/config.php";

$messages = [
    'CREATE' => 'Сообщение добавлено',
    'EDIT' => 'Сообщение изменено',
    'DELETE' => 'Сообщение удалено',

//    'ERROR1' => 'Укажите ваше имя',
//    'ERROR2' => 'Введите текст сообщения'
];

$action = 'create';
$btntext = 'Добавить';
$message = '';
$row = null;

switch ($_GET['action']) {
    case 'create':
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['name'])));
        $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['feedback'])));
        $sql = "INSERT INTO feedback(name, feedback) VALUES ('{$name}', '{$feedback}')";
        mysqli_query($link, $sql);
        header("location: ?message=CREATE");
        break;
    case 'edit':
        $id = (int)$_GET['id'];
        $result = mysqli_query($link, "SELECT * FROM feedback WHERE id = {$id}");
        if ($result) $row = mysqli_fetch_assoc($result);
        $action = 'save';
        $btntext = 'Редактировать';
        break;
    case 'save':
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['name'])));
        $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['feedback'])));
        $id = $_POST['id'];
        $sql = "UPDATE feedback SET name = '{$name}', feedback = '{$feedback}' WHERE id = {$id}";
        mysqli_query($link, $sql);
//        header("location: ?message=UPDATE");
        break;
    case 'delete':
        $id = (int)$_GET['id'];
        $sql = "DELETE FROM feedback WHERE id = {$id}";
        mysqli_query($link, $sql);
//        header("location: ?message=DELETE");
        break;
}

$result = mysqli_query($link, "SELECT * FROM feedback ORDER BY id DESC");

if (isset($_GET['message'])) {
    $message = $messages[$_GET['message']];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Document</title>
</head>
<body>
<?php include TEMPLATES_DIR . "menu.php" ?>
<div class="container">
    <h2>О нас</h2>
    <form action="?action=<?=$action?>" method="post">
        <input type="text" placeholder="Ваше имя" name="name" value="<?=$row['name']?>"><br>
        <input type="text" placeholder="Ваш отзыв" name="feedback" value="<?=$row['feedback']?>"><br>
        <input type="text" hidden name="id" value="<?=$row['id']?>">
        <input type="submit" value="<?=$btntext?>">
    </form>
    <?=$message?><br>
    <?php foreach ($result as $item): ?>
    <div class="feedback">
        <div class="feedback-data">
            <b><?=$item['name']?>:</b><?=$item['feedback']?>
        </div>
        <div class="feedback-actions">
            <a href="?action=edit&id=<?=$item['id']?>"><button>Редактировать</button></a><a href="?action=delete&id=<?=$item['id']?>"><button>X</button>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>