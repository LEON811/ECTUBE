<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/shop.css">
</head>

<body>
    <h1></h1>
    <table>
        <?php foreach ($goods as $g) {
            if (is_null($g['delete_date'])) { ?>
                <tr>
                    <td>
                        <?php echo img_tag($g['product_id']) //多分product_id
                        ?>
                    </td>

                    <td>
                        <p class="goods"><a href="product_detail.php?product_id=<?php echo $g['product_id'] ?>">
                                <?php echo "商品名:" . $g['product_name'] ?></a></p>
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
                        <p><?php //商品の値段表示
                            echo "値段:" . $g['product_price'] ?> 円</p>
                        <form action="cart.php" method="post">
                            <select name="num">
                                <?php
                                //商品個数
                                for ($i = 0; $i <= 9; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="product_id" value="<?php echo $g['product_id'] ?>">
                            <input type="submit" name="submit" value="カートへ">
                        </form>
                    </td>
                </tr>
        <?php }
        } ?>
        <a href="index_kanri.php">商品管理ページ</a>
    </table>
</body>

</html>