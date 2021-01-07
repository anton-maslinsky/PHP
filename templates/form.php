<?php if ($auth): ?>
    <span>Добро пожаловать <?=$name?>!</span><a href="/?logout"><button>Выйти</button></a>
<?php else: ?>
    <form class="form auth" action="?action=auth" method="post">
        <input type="text" name="login" placeholder="Введите логин" required>
        <input type="text" name="pass" placeholder="Введите пароль" required>
        Запомнить <input type="checkbox" name="save">
        <input type="submit" value="Войти"><br>
    </form>
    <a href="/registration.php"><button>Зарегистрироваться</button></a>
<?php endif; ?><br>

