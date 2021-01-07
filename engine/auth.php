<?php
session_start();
$session = session_id();

include "db.php";

$login = $_SESSION['login'];
$res = mysqli_query($link, "SELECT user_name FROM users WHERE login = '{$login}'");
$user_name = mysqli_fetch_assoc($res)['user_name'];

$auth = false;

if (isAuth()) {
    $auth = true;
    $name = get_user();
}

function isAdmin() {
    return $_SESSION['login'] == 'admin';
}

function isAuth() {
    global $link;
    if (!isset($_SESSION['id'])) {
        if (isset($_COOKIE["hash"])) {

            $hash = $_COOKIE["hash"];
            $sql = "SELECT * FROM users WHERE hash='{$hash}'";
            $result = mysqli_query($link, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $user = $row['login'];
                if (!empty($user)) {
                    $_SESSION['login'] = $user;
                }
            }
        }
    }

    return isset($_SESSION['login']);
}

if (isset($_GET['logout'])) {
    setcookie("hash", "", time()-1, "/");
    session_regenerate_id();
    session_destroy();
    header("Location: /");
    die();
}

function auth($login, $pass) {
    global $link;
    $login = mysqli_real_escape_string($link, strip_tags(stripslashes($login)));
    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '{$login}'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['pass'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
            return true;
        }
    }
    return false;


}

//if (!empty($_POST) && $_GET['action'] != 'reg' && $_GET['action'] != 'create' && $_GET['action'] != 'order')
if (!empty($_POST) && $_GET['action'] != 'reg' && $_GET['action'] != 'create' && $_GET['action'] != 'order') {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (auth($login, $pass)) {
        if (isset($_POST['save'])) {
            $hash = uniqid(rand(), true);
            $id = mysqli_real_escape_string($link, strip_tags(stripslashes($_SESSION['id'])));
            $sql = "UPDATE users SET hash = '{$hash}' WHERE id = {$id}";
            $result = mysqli_query($link, $sql);
            setcookie("hash", $hash, time() + 3600, "/");
        }
        header("Location: /");
        die();
    } else {
        die("Не верный логин пароль");
    }
}


function get_user()
{
    return $_SESSION['login'];
}


