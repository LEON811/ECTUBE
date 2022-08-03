<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <?php
            session_start();
            include("../db/pineapple.php");
            echo  $_SESSION['error'].'<br>';
            echo  $_POST['buy_size'].'<br>';
            echo  $_POST['buy_num'].'<br>';
            $_SESSION['error'] = "";

            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))// IPアドレス取得
            {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']; 
            }
            else{
                $ipaddress = $_SERVER['REMOTE_ADDR']; 
            }
            echo $ipaddress;
       ?>

    </body>
</html>