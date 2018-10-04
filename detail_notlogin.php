<?php
$id=$_GET['id'];

try {
  $pdo = new PDO('mysql:dbname=gs_f01_db28;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=:id');
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  //エラーのとき
  errorMsg($stmt);
}else{
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["name"]などで値をとれる
  // var_dump()で見てみよう
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>更新ページ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="select_notlogin.php">ブックマーク一覧</a>
    </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>更新ページ</legend>
     <label>タイトル：<?=$rs['title']?></label><br>
     <label>URL：<?=$rs['url']?></label><br>
     <label>コメント：<?=$rs['comment']?></label><br>
     <!-- idは変えたくない = ユーザーから見えないようにする-->
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>