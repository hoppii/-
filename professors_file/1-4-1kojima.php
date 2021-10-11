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
        $sql  = 'INSERT INTO kojima (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/1-4-1kojima.php');
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
    <title>小島ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>小島ゼミの口コミページ</h1>
<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>建築・都市、環境工学、環境心理、ニーズ・CS（顧客満足）、利用者行動、調査手法</h4>
<hr>
<p>

住居・建築・都市など様々な環境に関する人々、特に顧客（利用者、居住者、所有者、etc）の意識・行動・ニーズ・CSを把握し、役立てるための研究。<br>
以下はWebでアクセスできるいくつかの成果。<br>
・住まい選び支援「住みここち心理テスト」（2004～2014年までリクルート社によりWeb上で運用）<br>
（関連する講義資料> https://drive.google.com/open?id=1-38NMX97GtaaeyzPUaDDOEnOiChW5Rpw )<br>
・公共施設のニーズ・CS（http://www.kenken.go.jp/japanese/research/lecture/h16/index.html）<br>
・高齢者福祉施設の環境づくりプログラム（http://www.kankyozukuri.com/）<br>
・計画的な防犯まちづくり支援(http://evisapo.com/)<br>
・エビデンスに基づいた安全な生活環境づくり「エビサポ」（http://evisapo.com/）<br>
・オフィスの知的生産性測定システム(http://www.jsbc.or.jp/sap/index.html)<br>
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM kojima';
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