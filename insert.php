<?php
require 'common_kanri.php';
$category_id = "";
$error = $product_name = $product_inventory = $product_maker = $product_number = $size = $product_description = $product_price = '';
$pdo = connect();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
} else {
    $error .= "ログインしてください";
}

if (@$_POST['submit']) {
    $product_name = $_POST['product_name'];
    $product_description = "'" . $_POST['product_description'] . "'";
    $product_price = $_POST['product_price'];
    $product_inventory = $_POST['product_inventory'];
    $product_maker = "'" . $_POST['product_maker'] . "'";
    $product_number = "'" . $_POST['product_number'] . "'";
    $size = "'" . $_POST['size'] . "'";

    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
    } else {
        // $error .= '商品カテゴリーを選択していません。<br>';
        $category_id = 'NULL';
    }

    if (!$product_name) $error .= '商品名がありません。<br>';
    if (!$product_price) $error .= '価格情報がありません。<br>';
    if (!$product_inventory) $product_inventory = 'NULL';
    if (!$product_maker) $product_maker = 'NULL';
    if (!$product_number) $product_number = 'NULL';
    if (!$product_description) $product_description = 'NULL';
    if (!$size) $size = 'NULL';
    if (preg_match('/\D/', $product_price)) $error .= '価格が不正です。<br>';

    if (!$error) {
        $pdo->query("INSERT INTO products(product_id,user_id,category_id,product_name,product_price,product_inventory,product_maker,image_id,product_number,product_description,size,delete_date,upload_date,discount)
        VALUES(default,$user_id,$category_id,'$product_name',$product_price,$product_inventory,$product_maker,default,$product_number,$product_description,$size,default,now(),default)");
        header('Location: index_kanri.php');
        exit();
    }
}
require 't_insert.php';
