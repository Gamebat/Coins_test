<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale for coins</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" media="screen and (max-width: 480px)" href="./css/mobile.css">
    <script defer src="./js/jquery-3.6.1.min.js"></script>
    <script defer src="./js/script.js"></script>
</head>
<body>
    <?php
        session_start();
        require_once './controllers/database.php';

        if (isset($_POST['login']) && $_POST['login'] != "" ){
            $_SESSION = array();
            $name = $_POST['login'];

            $login = $name;

            $user = DB::run("SELECT * FROM `users` WHERE `login` = '$login'") -> rowCount();
        }
        if ((isset($user) && $user !=0) || (isset($_SESSION['user']))){

            if (!isset($_SESSION['user'])){
                $user = DB::run("SELECT * FROM `users` WHERE `login` = '$login'") -> fetch(PDO::FETCH_LAZY);
                $user_id = $user['id'];
                $_SESSION['user']=$user_id;
                
                $user_name = $user['name'];
                $_SESSION['name'] = $user_name;
            }else{
                $user_id = $_SESSION['user'];
            }
            $orders = DB::run("SELECT * FROM `orders_users` WHERE `user_id` = '$user_id'");

            $coins = DB::run("SELECT DISTINCT `action`, `price` FROM `coins` WHERE `user_id` = '$user_id'");
            $balance = 0;
            while ($coi = $coins->fetch(PDO::FETCH_LAZY)){
                $action = $coi['price'];
                $balance += $action;
            }
            $_SESSION['balance']=$balance;
            
            $orders_array = [];
            while ($ord = $orders->fetch(PDO::FETCH_LAZY)){
                $orders_array[] = $ord['product_id'];
            }
        }else{
            $balance = 0;  
        }

            $products_descrip_arr=[];
            $products_price_arr=[];

            $products = DB::run("SELECT * FROM `products`");
            while ($pr = $products->fetch(PDO::FETCH_LAZY)){
                $products_price_arr[] = $pr['price'];

                $products_descrip_arr[] = $pr['description'];
            }

            $pr_sale = [];
            $pr_descrip = [];
            for ($i = 0; $i <= count($products_descrip_arr) - 1; $i++) {
                $pr_sale[] = mb_substr($products_descrip_arr[$i], 0, 3);
                $pr_descrip[] = mb_substr($products_descrip_arr[$i], 4);
            }


       
    ?>

    <script>

        <?php

        $php_array = array('abc','def','ghi');

        $js_array  = json_encode($orders_array);

        echo "var javascript_array = ". $js_array . ";\n";

        ?>
    </script>

    <div class="center">

    <div class="modal" id="instruction">
        <div id="okno">
            <a class="exit" href="#"></a>
            <h4>Инструкция</h4>
            <p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
            <p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
            <p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
            <p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
        </div>    
    </div>

    <header>

    <?php
    echo "
        <div class='balance'>

        <h1>Ваш баланс:</h1>
        <div class='coins'>
            <img class='coin' src='./img/coin.png' alt='coin'>
            <p class='value'>{$balance}</p>
            
            <p class='currency'>ET</p>
        </div>

     </div><div class='sales'>
        <h2>Варианты обмена на скидку</h2>
        <a href='#instruction'>Инструкция</a>
        <div class='options'>

        <div class='object'>
            <div class='coins'>
                <img src='./img/coin.png' alt='coin'>
                <p class='cost'>{$products_price_arr[0]}</p>
                <p class='currency'>ET</p>
            </div>
            <img src='./img/phone.png' alt='phone'>
            <div class='title'>
                <p class='sale'>{$pr_sale[0]}</p>
                <p class='saletext'>{$pr_descrip[0]}</p>
            </div>
            <form class='formi' id='123' action='./controllers/productBuy.php' method='post'>

                <input hidden type='text' id='saleid' name='saleid' value='1'>
                <button id='btn1' class='select'>Использовать скидку</button>

            </form>
        </div>

        <div class='object'>
            <div class='coins'>
                <img src='./img/coin.png' alt='coin'>
                <p class='cost'>{$products_price_arr[1]}</p>
                <p class='currency'>ET</p>
            </div>
            <img src='./img/book.png' alt=''>
            <div class='title'>
                <p class='sale'>$pr_sale[1]</p>
                <p class='saletext'>{$pr_descrip[1]}</p>
            </div>

            <form class='formi' id='123' action='./controllers/productBuy.php' method='post'>

                <input hidden type='text' id='saleid' name='saleid' value='2'>
                <button id='btn2' class='select'>Использовать скидку</button>

            </form>
        </div>

        <div class='object'>
            <div class='coins'>
                <img src='./img/coin.png' alt='coin'>
                <p class='cost'>{$products_price_arr[2]}</p>
                <p class='currency'>ET</p>
            </div>
            <img src='./img/books.png' alt=''>
            <div class='title'>
                <p class='sale'>$pr_sale[2]</p>
                <p class='saletext'>{$pr_descrip[2]}</p>
            </div>
            
            <form class='formi' id='123' action='./controllers/productBuy.php' method='post'>

                <input hidden type='text' id='saleid' name='saleid' value='3'>
                <button id='btn3' class='select'>Использовать скидку</button>

            </form>
        </div>

        <div class='object'>
            <div class='coins'>
                <img src='./img/coin.png' alt='coin'>
                <p class='cost'>{$products_price_arr[3]}</p>
                <p class='currency'>ET</p>
            </div>
            <img src='./img/books.png' alt=''>
            <div class='title'>
                <p class='sale'>$pr_sale[3]</p>
                <p class='saletext'>{$pr_descrip[3]}</p>
            </div>
            
            <form class='formi' id='123' action='./controllers/productBuy.php' method='post'>

                <input hidden type='text' id='saleid' name='saleid' value='4'>
                <button id='btn4' class='select'>Использовать скидку</button>

            </form>
        </div>


        </div>
        </div>
    "
    ?>
    </header>


    <main>
        <form class="myform" id="123" action="" method="post">

            <div class="formheader">
                <p class="">Введите логин пользователя</p>
                
                <input type="text" id="login" name="login" placeholder="Логин">

            </div>

            <div class="">

                <button class="send" type="submit">Далее</button>
                
            </div>

        </form>

        <?php
            if (isset ($user_name)){
                echo "<p class='user-name'>Получены данные для пользователя: {$user_name}</p>";
            }else if (isset($_SESSION['name']) ){
                $user_name = $_SESSION['name'];
                echo "<p class='user-name'>Получены данные для пользователя: {$user_name}</p>";
            }
        ?>
    </main>
    
    </div>

    
</body>
</html>