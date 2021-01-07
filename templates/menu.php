<nav class="menu">
    <a class="menu_link" href="/">Главная</a>
    <a class="menu_link" href="/feedback.php">О нас</a>
    <a class="menu_link" href="/gallery.php">Галерея</a>
    <a class="menu_link" href="/catalog.php">Каталог</a>
    <a class="menu_link" href="/cart.php">Корзина (<?=$count?>)</a>
    <?php if(isAdmin()): ?>
    <a class="menu_link" href="/admin.php">Админка</a>
    <?php endif;?>
</nav>