<?php
define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']);
define("ENGINE_DIR", DIR_ROOT . '/engine/');
define("TEMPLATES_DIR", DIR_ROOT . '/templates/');

define("BIGIMG", "../img/big/");
define("SMALLIMG", "../img/small/");
define("PRODUCTIMG", "../img/prod/");

include ENGINE_DIR . "auth.php";
include ENGINE_DIR . "db.php";
include ENGINE_DIR . "functions.php";
include_once ENGINE_DIR . "resize.php";
