<?php
session_start();
include('../db/pineapple.php');
include('./db_connect.php');
date_default_timezone_set('Asia/Tokyo');
    if(isset($_POST['email'])&isset($_POST['password'])){

        $email = $_POST['email'];

        try{
            
            //DB接続オブジェクト
            //PDO…PHP Data Object
            $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
            //let logo = getElementById('id');
        
            //PDOの設定変更
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $pdo->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );

            $sql = "select user_id,user_password,user_name,user_icon from user where email = '$email'";
            $dbh = $pdo->query($sql);
    
    
            while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
                //インスタンスのみ→PDO::FETCH_NUM
                //連想配列のみ→PDO::FETCH_ASSOC
                //両方→PDO::FETCH_BOTH（メモリの無駄）
                //print_r($record);
                $id= $record["user_id"];
                $password = $record["user_password"];
                $user_name= $record["user_name"];
                $user_icon= $record["user_icon"];
            }
            
            if(password_verify($_POST['password'],$password)){
                
                //ログイン中　user_idとuser_nameをセッションに保存
                $_SESSION["user_id"] = $id;
                $_SESSION["user_name"] = $user_name;
                $_SESSION["customer_status"] = "member";


                ///////user ip保存///////
                $pdo = db_connect();
                //let logo = getElementById('id');
            
                //PDOの設定変更
                $pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                $pdo->setAttribute(
                    PDO::ATTR_EMULATE_PREPARES,
                    false
                );

                
                //SQL文作成
                $sql = "UPDATE user SET recent_ip = :recnt_ip, recent_login = :recent_login WHERE user_id = :user_id";
                //プリペアードステートメントの設定と取得
                $prestmt = $pdo->prepare($sql);

                $prestmt->bindValue(':user_id', $id);
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))// IPアドレス取得
                {
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR']; 
                }
                else{
                    $ipaddress = $_SERVER['REMOTE_ADDR']; 
                }
                $prestmt->bindValue(':recnt_ip', $ipaddress);
                $date = date('Y-m-d H:i:s');
                $prestmt->bindValue(':recent_login',  $date, PDO::PARAM_STR);
                //SQL実行
                $prestmt->execute();
                ///////////////////


                //会員ICON　
                $_SESSION["user_icon"] = $user_icon;

                $url =  parse_url($_POST['page'])['path'];
                if($url =='/pineapplelive.tk/register' || $url =='/pineapplelive.tk/register.php'){
                    header("Location:index.php ");
                    exit;
                }
                else{
                    header("Location: ".$_POST['page']);
                    exit;
                }


            }
            else{
                $_SESSION["error"] = 'ユーザーIDまたはパスワードに間違いがあります。';
                header("Location: login");
                exit;
            }
        }
    
        catch (PDOException $e) {
            print('接続失敗:' . $e->getMessage());
            die();
        }

    }
    else{
        header("Location: login");
    
    }
?>