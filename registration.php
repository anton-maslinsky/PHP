<?php
$link = '';
include "./config/config.php";

$messages = [
    'ERROR' => 'Пользователь с таким логином уже существует!',
    'OK' => 'Поздравляем, вы зарегистрированы!'
];
if (!empty($_POST)) {
//    $name = $_POST['user_name'];
    $name = mysqli_real_escape_string($link, strip_tags(stripslashes($_POST['user_name'])));
//    $login = $_POST['login'];
    $login = mysqli_real_escape_string($link, strip_tags(stripslashes($_POST['login'])));
//    $pass = $_POST['pass'];
    $pass = mysqli_real_escape_string($link, strip_tags(stripslashes($_POST['pass'])));

    $select = "SELECT * FROM users WHERE login = '{$login}'";
    $result = mysqli_query($link, $select);


    if (mysqli_num_rows($result) == 0) {
        $hash = uniqid(rand(), true);
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_name, login, pass, hash) VALUES ('{$name}', '{$login}', '{$passHash}', '{$hash}')";
        mysqli_query($link, $sql);
        header("location: ?message=OK");
        die();
    }
    else {
        header("location: ?message=ERROR");
        die();
    }
}
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
<?php include "./templates/menu.php"; ?>
<div class="container">
    <?=$message?>
    <form class="form registration" action="?action=reg" method="post">
        <input type="text" name="user_name" placeholder="Введите имя" required>
        <input type="text" name="login" placeholder="Введите логин" required>
        <input type="text" name="pass" placeholder="Введите пароль" required>
        <input type="submit" value="Зарегистрироваться">
    </form>
</div>
</body>
</html>