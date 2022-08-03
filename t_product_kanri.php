<?php include("./includes/header.php");?>
<title>商品一覧</title>
<link rel="stylesheet" href="css/kanri.css">
<?php include("./includes/navbar.php");?>
<main>


    <table>
        <?php foreach ($goods as $g) {
            if (is_null($g['delete_date'])) { ?>
                <tr>
                    <td>
                        <?php echo img_tag($g['product_id']) ?>
                    </td>

                    <td>
                        <p class="goods">
                            <?php //商品名 表示
                            echo "商品名:" . $g['product_name'] ?></p>
                        <p><?php //商品説明 表示
                            echo "商品説明:" . nl2br($g['product_description']) ?></p>
                        <p><?php //メーカー 表示
                            echo "メーカー:" . nl2br($g['product_maker']) ?></p>
                        <p><?php //品番 表示
                            echo "品番:" . nl2br($g['product_number']) ?></p>
                        <p><?php //サイズ 表示
                            echo "サイズ:" . nl2br($g['size']) ?></p>
                        <p><?php //在庫 表示
                            echo "在庫:" . nl2br($g['product_inventory']) ?></p>
                    </td>

                    <td width="80">
                        <p><?php echo "値段:" . $g['product_price'] ?> 円</p>
                        <p><a href="product_edit.php?product_id=<?php echo $g['product_id'] ?>">修正</a></p>
                        <p><a href="product_img_upload.php?product_id=<?php echo $g['product_id'] ?>">画像</a></p>
                        <p><a href="product_delete.php?product_id=<?php echo $g['product_id'] ?>" onclick="return confirm('削除してよろしいですか？')">削除</a></p>
                    </td>
                </tr>
        <?php }
        } ?>
    </table>
    <div class="base">
        <a href="product_insert.php">新規追加</a>　
        <a href="main_product.php" target="_blank">サイト確認</a>
    </div>

</main>
<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>

</html>