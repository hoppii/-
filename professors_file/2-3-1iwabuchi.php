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
        $sql  = 'INSERT INTO iwabuchi (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/2-3-1iwabuchi.php');
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
    <title>巖淵ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>巖淵ゼミの口コミページ</h1>
<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>支援技術、福祉工学、ICT、障害、バリアフリー、生活支援、教育支援</h4>
<hr>
<p>
本研究室では，障害のある人や高齢の人など，様々なバリアを抱える人々に役立つテクノロジーの創造と利用推進，<br>
およびそれを通じた多様性を受け入れる社会の実現を目指した支援技術の研究開発を行っています。<br>
近年，スマートフォンやタブレットなど，<br>
身の回りにあるテクノロジー（アルテク）を活用することで開発コストを大幅に抑えた支援技術開発が世界的トレンドとなっています。<br>
しかし，そこで生まれた製品がユーザーに受け入れられ，広く使われるとは限りません。<br>
当事者のニーズと技術シーズのマッチングはもとより，流行やインフラ整備，法制度など，<br>
社会の変化にも対応した技術開発・利用のビジョンを示す必要があります。<br>
障害のある人に対する技術的な支援は，機能補償から代替へ，そして能力増強へとその歩みを加速させています。<br>
私達は，これまでの支援の未踏領域を志向しながら，支援技術の普及促進をはかる国際的スキームの提案を目指します。<br>
工学的アプローチを軸にしながら，現場に密着した学際的研究を実施しています。<br>
研究ホームページ：https://iwalab.jp/
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM iwabuchi';
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