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
        $sql  = 'INSERT INTO katoMaki (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/3-3-1katoMaki.php');
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
    <title>加藤ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>加藤ゼミの口コミページ</h1>
<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>作業安全，健康管理，効率改善，負担軽減</h4>
<hr>
<p>
毎日の生活における安全性と効率性に関する課題をフィールドより抽出し，<br>
人間工学手法により定量的に計測，評価することで，生活の質の向上を目的とする研究をします．<br>
道路交通や航空，工場，また公園や住宅をフィールドとして，人間工学，経営工学とともに，<br>
認知心理学や社会心理学にかかる研究も数多く実施しています．<br>
以下は最近の主な研究です．<br>
・介護作業者の解除作業における負担の定量的評価と作業改善<br>
・注視点計測による文字情報の難易度と伝達容易性との関連性の定量的評価<br>
・一般的な家電製品の事故発生危険性に対する評価と客観的事故リスクとの乖離の定量的評価<br>
・公園遊具からの転落事故における衝撃軽減手法と傷害発生防止手法の開発<br>
・靴使用条件による立位姿勢特性，歩行姿勢特性の変化に対する定量的評価<br>
・自転車の走行安全性に必要な道路条件の改善と安全対策の効果<br>
・自動車運転シミュレータを用いた運転中の危険回避行動特性の定量的評価<br>
・VRを用いた視覚刺激提示と身体の重心同様との関連性<br>
・歩行中のスマートフォン操作における歩行動作シミュレーション<br>
・航空機の操縦において生じる事故リスクの回避判断モデルの構築<br>
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM katoMaki';
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