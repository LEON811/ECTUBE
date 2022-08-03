<?php
session_start();
include("./db/pineapple.php");
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    header("Location: login.php");
}
if(isset($_POST['live_id'])){
    $_SESSION['live_id']=$_POST['live_id'];
}

if(isset($_SESSION['live_id'])){
    $live_id = $_SESSION['live_id'];
}


$error="";
if(isset($_SESSION['error'])){
    $error=$_SESSION['error'];
    $_SESSION['error']="";
}

$dsn = "mysql:host = 127.0.0.1;dbname=db_kdk;charset=utf8mb4";
$db_user = "root";
$db_password = "";
$pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
$pdo->setAttribute(
PDO::ATTR_ERRMODE,          
PDO::ERRMODE_EXCEPTION);    

$sql = "SELECT user_id FROM live WHERE live_id = '$live_id'";
$dbh = $pdo->query($sql);
while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
    $vtuber_id=$record["user_id"];
}

if($user_id!=$vtuber_id){
    header("Location:". $_SERVER['HTTP_REFERER']);
    exit;
}

?>
<?php include("includes/header.php");?>
<?php include("includes/navbar.php");?>

<div class="row justify-content-center">
    <h5 class="text-danger"><?php echo $error;?></h5>
</div>
<div class="row justify-content-center">
    <div class="col-auto">
        <form action="uploader.php" name="register"  method = "post">
            <input  type='hidden' value='edit_live_product' name='upload_mode'>
            <input  type='hidden' value='<?php echo $live_id?>' name='live_id'>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action active">商品リンクを入力してください</li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
            </ul>

            
        <div class="row my-3 justify-content-end">
            <div class="col-auto">
                <input type = "submit" class="btn btn-primary ml-2 pull-right" value ="確認">
                <a href="<?php echo 'live.php?live_id='.$live_id?>"><button class="btn btn-secondary hBack pull-right" type="button">戻る</button></a>
            </div>
        </div>
        </form>
    </div>
</div>

<?php include("includes/footer.php");?>
<?php include("includes/script.php");?>