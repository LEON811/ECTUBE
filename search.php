<?php session_start();?>

<?php include("./search_process.php");?>

<?php include("./includes/header.php");?>
<title>Pineapple</title>
<style>
img{
    object-fit:cover;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
    
    include("./includes/navbar.php");
?>

<main role="main">

<div class="container">
    <div class="d-flex align-items-center">
        <h4 class="my-2"><?php echo $keyword."  検査結果"?></h4>
    </div>
    <hr>
</div>


<div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-shopping-basket  fa-2x mr-3" aria-hidden="true"></i><h4 class="my-4">商品</h4>
    </div>

    <div id = 'new_product' class="row">
        <?php foreach($all_product as $good){?>
            <div class="col-md-3">
                <div class="card mb-3 shadow-sm" style="height:380px">
                <img id = "product_img" src="<?php echo $good['image_id'];?>" alt="procust_img" style="height:200px; ">
                    <div class="card-body card-body d-flex flex-column justify-content-center">
                        <p class="card-text text-center fw-bolder h6"><a href="<?php echo 'product_detail?product_id='.$good['product_id']?>">
                        <?php echo $good['product_name'] ?></a></p>
                        <span class="small"><p class="text-center text-muted"><?php echo $good['product_maker']?></p></span>
                        <p class="text-center h6"><?php echo "￥".number_format($good['product_price'])?></p>
                    </div>
                </div>
            </div>
        <?php };?>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-film fa-2x mr-3" aria-hidden="true"></i><h4 class="my-4">動画</h4>
    </div>

    <div id = 'new_video' class="row">
    <?php foreach($all_video as $video){?>
        <div class="col-md-3">
            <div class="card mb-5 shadow-sm">
                    <img src="<?php echo $video['thumbnail']?>" alt="thumbnail">
                <div class="card-body">
                    <p class="card-text fw-bolder"><a href="<?php echo "video?video_id=".$video['video_id']?>"><?php echo $video['video_title']?></a></p> 
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="<?php echo $video['user_icon']?>" class="rounded-circle float-left" alt="user_icon" style = "height:60px; width:60px;">
                        <div class="d-flex align-items-start flex-column ml-3 ">
                            <small class="text-center text-muted"><?php echo $video['user_name']?></small>
                            <small class="text-muted"><?php echo $video[28]?></small> 
                        </div> 
                    </div>        
                </div>
            </div>
        </div>
        <?php };?>
        
    </div>
</div>



</main>


<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>
