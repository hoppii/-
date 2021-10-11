<?php
// データベース設定
define('DB_DNS', 'mysql:host=localhost; dbname=tokolog; charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 12345678);

// データベースへ接続
try {
  $dbh = new PDO(DB_DNS, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

// データベースへ登録 
if(!empty($_POST['name']) && !empty($_POST['comment'])){
    try{    
        $sql  = 'INSERT INTO osu (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/2-1-1osu.php');
        exit();
    } catch (PDOException $e) {
        echo 'データベースにアクセスできません！'.$e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>大須ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>大須ゼミの口コミページ</h1>
<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>脳科学、心理学、脳計測、生体計測、身体性、社会性、潜在性、学習、ニューロモジュレーション、臨床応用、ニューロリハビリテーション</h4>
<hr>
<p>
超高齢化社会をむかえ、心と身体の機能を維持、回復、向上させる技術の開発は急務です。<br>
生涯にわたって健康で幸福な生活を維持するためには、心身を包括的に制御する脳・神経系を健全に保つ必要があります。<br>
脳・神経活動を計測する技術の向上や認知神経科学・計算神経科学といったシステム神経科学による知見の蓄積により、脳・神経の機能的理解がすすんできました。<br>
その結果、脳・神経系には、変化する外界に柔軟に対応し、新たなことを学習したり、失われた機能を取り戻そうとしたりする力があること、<br>
またそのメカニズムが少しずつ明らかになってきました。<br>
そして、その知見を機能の維持や改善に役立てる応用研究が現実味を帯びてきました。<br>
本ゼミでは、システム神経科学のこれまでの知見と方法論をベースに、<br>
行動実験や脳計測、計算機実験などで意識にのぼらない心や身体の仕組みにアプローチしたり、<br>
脳や身体に介入する手法で行動や心的状態を修飾する研究を進めていきます。<br>
研究室全体として、基礎研究と応用研究の橋渡しとなりうることを希望しています。<br>
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM osu';
$result = $dbh->query($sql);

echo "<table>" ;
echo "<tr><th>No.</th><th>お名前</th><th>コメント</th></tr>" ;
foreach ($result as $val){
echo "<tr>" ;
echo "<td>" . $val["id"] . "</td>" ;
echo "<td>" . $val["name"] . "</td>" ;
echo "<td>" . $val["comment"] . "</td>" ;
echo "</tr>" ;
}
echo "</table>" ;
?>

</div>

    
    


<!-- 口コミ投稿フォーム -->
<div class="container" id="input_form">
<h2>口コミ投稿</h2>
<p>このゼミについての口コミを書き込もう！</p>

<form method="POST" action="">
    <p><label>お名前（ニックネーム可）<br>
    <input type="text" name="name" id="input_name">
    </label></p>
    
    <p><label>書き込み内容<br>
    <textarea name="comment" id="input_comment"></textarea>
    </label></p>
        

    <p><input type="submit" value="送信" id="submit_button"></p>
</form>
</div>



</div>
</body>
</html>