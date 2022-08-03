<?php 
    include("./db_connect.php");
    
    $keyword = "";
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
    else{
        header("Location:index.php");
        exit;
    }


    try{
        $pdo = db_connect();
    
        //PDOの設定変更
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $pdo->setAttribute(
            PDO::ATTR_EMULATE_PREPARES,
            false
        );

        //商品検索
        //SQL文作成
        $sql = "SELECT * FROM products p,product_category c,user u WHERE p.category_id = c.category_id AND p.user_id = u.user_id AND p.delete_date IS NULL AND (p.product_name like '%$keyword%' OR p.product_description like '%$keyword%' OR c.category_name like '%$keyword%')";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);

        $prestmt->bindValue(':keyword', $keyword);
        //SQL実行
        $prestmt->execute();
        //抽出結果取得
        $dbh = $prestmt->fetchALL(PDO::FETCH_ASSOC);
        //live_id　取得//
        $all_product = $dbh;



        //動画検索
        //SQL文作成
        $sql = "SELECT * FROM user u,video v LEFT JOIN products p ON p.product_id  = v.product_id WHERE v.user_id = u.user_id AND v.delete_date IS NULL AND (p.product_name like '%$keyword%' OR p.product_description like '%$keyword%' OR v.video_title like '%$keyword%' OR v.description like '%$keyword%')";
        //プリペアードステートメントの設定と取得

        //echo $sql;
        $prestmt = $pdo->prepare($sql);
        //SQL実行
        $prestmt->execute();
        //抽出結果取得
        $dbh = $prestmt->fetchALL(PDO::FETCH_BOTH);
        //live_id　取得//
        $all_video = $dbh;
    }
    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }
/*
    echo "<br><pre>";
    var_dump($all_video);
    echo "</pre>";
    echo $keyword;*/
?>

