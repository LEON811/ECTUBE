<?php
  session_start();
  if(empty($_SESSION['user_id'])){
    header('Location: login');
    exit;
  }
?>
<?php include("./includes/header.php");?>
<?php include("./includes/navbar.php");?>


<main>
<section class="mx-5 mt-3 mb-5 pb-3 px-5">
    <h4 style="margin-left:90px;">マイページ</h4>
    <div class="container mt-4">
        <div class="row text-center g-2">
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="member_info" role="button"> 会員情報変更 &raquo;</a></p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-cart-arrow-down fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="index_kanri" role="button"> 商品管理 &raquo;</a></p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-film fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="video_admin" role="button"> 動画管理 &raquo;</a></p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-video-camera fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="live_admin" role="button"> ライブ管理 &raquo;</a></p>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-history fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="order_history" role="button"> 購入履歴 &raquo;</a></p> 
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 shadow p-3 mb-5 bg-body rounded">
                    <i class="fa fa-file-text fa-5x" aria-hidden="true"></i>
                    <p><a class="btn btn-primary mt-4" href="sell_history" role="button"> 販売履歴 &raquo;</a></p>
                </div>
            </div>
        </div>
    </div>	
</section>
</main>



<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>