<?php
session_start();
require_once 'database.php';

$user = $_SESSION['user'];
        
if (isset($_POST['saleid'])){
    $product = ($_POST['saleid']);

    $buyed = DB::run("SELECT `price` FROM `products` WHERE `id` = '$product'") -> fetch(PDO::FETCH_LAZY);
    $pr = $buyed['price'];

    if ($pr > $_SESSION['balance']){
     
        header ('Location: ../index.php?false');
        return;
    }

    DB::run("INSERT INTO `orders_users` (`product_id`, `user_id`) VALUES('$product', '$user')");
    $price = -$pr;
    $action = "buy".$product;
    DB::run("INSERT INTO `coins` (`user_id`, `price`, `action`) VALUES('$user', '$price', '$action' )");

    header ('Location: ../index.php');
}

