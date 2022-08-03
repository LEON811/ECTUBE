<?php
session_start();
include("./db_connect.php");
$error="";
if(isset($_SESSION['error'])){
    $error=$_SESSION['error'];
    $_SESSION['error']="";
}
if(!$_SESSION['user_id']){
    header("Location: login.php");
    exit;
}else{
    $User_ID = $_SESSION['user_id'];
    try{

        
        //DB操作用オブジェクトの作成
        $pdo = db_connect();
    
        //PDOの設定変更（エラー黙殺→例外発生）
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,          //3
            PDO::ERRMODE_EXCEPTION);    //2
        
        //LIVE_ID ゲット
        $sql = "select live_id,title,live_key from live where user_id = $User_ID order by live_id desc LIMIT 1";
        $dbh = $pdo->query($sql);


        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $Live_ID= $record["live_id"];
            $Title= $record["title"];
            $live_key = $record["live_key"];

        }
        if(isset($Live_ID)){
            $live_key = $Live_ID;
            $live_title = $Title;
        }

    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }
}

//live key 生成されたら　画面に表示
$print = "";
if(!empty($Live_ID)){
    $print = "<h2>ストリームキー</h2>
                <h3 style = 'color = blue;'>$live_key</h3>
                <h2>ライブタイトル</h2>
                <h3>$Title</h3>";
}
?>


<?php include("includes/header.php");?>
<?php include("includes/navbar.php");?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ライブ情報を入力してください</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="uploader.php" name="register"  method = "post" enctype="multipart/form-data">
            <input  type='hidden' value='live_page' name='upload_mode'>
            <input  type='hidden' value="<?php echo $User_ID?>" name='user_id'>
            
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                        <th scope="row">タイトル<span class="badge bg-danger">必須</span></th>
                        <td><input type="text" name="title" size="60"  required></td>
                        </tr>

                        <tr>
                        <th scope="row">ライブ概要</th>
                        <td><textarea name="live_description" rows="4" cols="60"></textarea></td>
                        </tr>
                        
                        <tr>
                        <th scope="row">サムネイル</th>
                        <td><input type="file" name="thumbnail"></td>
                        </tr>
                    </tbody>
                </table>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
        <input type = "submit" class="btn btn-primary" value ="確認">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal end -->

<!-- main content -->
<main class="mx-5">
    <div class="row mb-3">
        <div class="mt-3 ">
            <h4 class="float-left">ライブ一覧</h4>
            <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">新しいライブを作成</button>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table text-center">
        <thead>
            <tr>
            <th scope="col">タイトル</th>
            <th scope="col">概要</th>
            <th scope="col">日時</th>
            <th scope="col">ストリームキー</th>
            <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $get_live="SELECT * From live WHERE user_id='$User_ID' ORDER BY start_date DESC";
        $run_get_live = $pdo->query($get_live);
        $count = $run_get_live->rowCount();
        if($count> 0){
            foreach($run_get_live as $row){
        ?>
        <tr>
            <td>
                <?php 
                    $title = $row["title"];
                    $id = $row['live_id'];
                    echo "<a href='./live?live_id=$id'>$title</a>";

                ?><br>
                <?php 
                    $thumbnail ="";
                    if(empty($row["thumbnail"])){
                        $live_id = $row['live_id'];
                        $thumbnail = "./files/thumbnail/$live_id.jpg";
                        if (!file_exists($thumbnail)){
                            $thumbnail = "./files/thumbnail/noimage.jpg";
                        }
                    }
                    else{
                        $thumbnail = $row['thumbnail'];
                    }
                ?>
                <img src='<?php echo $thumbnail;?>' alt="thumbnail" style="width:120px; height:80px;">
            </td>
            <td><?php echo nl2br($row["description"]);?></td>
            <td><?php echo $row["start_date"];?></td>
            <td><?php echo $row["live_key"];?></td>
            <td><button type="button" class="btn btn-primary">編集</button></td>
        </tr>
        <?php
            }
        }
        ?>          
        </tbody>
    </table>
</div>
​
    <div class="row my-4">
        <div>
            <a href="mypage" class="btn btn-secondary float-right">戻る</a>
        </div>
    </div>
</main>

<!--生成したページ情報-->
 <?//php echo $print; ?> 


 <?php include("includes/footer.php");?>
 <?php include("includes/script.php");?>
