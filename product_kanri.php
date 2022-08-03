<?php
require 'common_kanri.php';
$pdo = connect();
$st = $pdo->query("SELECT * FROM products");
$goods = $st->fetchAll();
require 't_product_kanri.php';
