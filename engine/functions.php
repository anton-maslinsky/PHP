<?php
//Математические функции для калькулятора
function sum($arg1, $arg2){
    return ($arg1 + $arg2);
}

function sub($arg1, $arg2){
    return ($arg1 - $arg2);
}

function mul($arg1, $arg2){
    return ($arg1 * $arg2);
}

function div($arg1, $arg2){
    return ($arg2 == 0) ? "На ноль делить нельзя!" : $arg1 / $arg2;
}

function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case "+":
            return sum($arg1, $arg2);
        case "-":
            return sub($arg1, $arg2);
        case "*":
            return mul($arg1, $arg2);
        case "/":
            return div($arg1, $arg2);
        default:
            return "Неправильная операция";
    }
}

$session = session_id();
$result = mysqli_query($link, "SELECT SUM(`qty`) as count FROM `cart` WHERE `session_id` = '{$session}'");
$count = mysqli_fetch_assoc($result)['count'];
