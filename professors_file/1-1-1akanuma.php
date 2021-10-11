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
        $sql  = 'INSERT INTO akanuma (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/1-1-1akanuma.php');
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
    <title>赤沼ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>赤沼ゼミの口コミページ</h1>

<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>生命のルーツ、原始生物と古代地球環境、アストロバイオロジー、酵素、タンパク質工学、生物機能利用、極限環境微生物</h4>
<hr>
<p>
「人類はどのように誕生し、この先どこへ向かうのか？」<br>
赤沼研究室では、人類や（微）生物と地球環境の共栄・共存の過去・現在・未来について研究しています。<br>
(1) 地球に最初の生命が誕生したのは40億年も前のことです。しかも、人類から微生物まで地球上の全生物はたった一つの共通祖先生物から進化したと考えられています。
人類の真のルーツを探るため、40億年前の遺伝子を復元・解析し、原始生命の姿とその環境を調べています。
さらに、40億年に渡る地球環境の変遷と生物進化の関わりから、原始生命から人類に至る進化の歴史も調べています。
加えて、宇宙における生命の誕生・存在の可能性についても検討しています。<br>
(2) 持続可能な開発目標SDGsの達成に向けて、生物が持つ機能を利用することによって、二酸化炭素排出量を抑えた無駄の少ない環境調和型のモノ作り、システム作りに貢献することを目指しています。
特に、遺伝子工学やタンパク質工学の技術を駆使して極限環境微生物が持つタンパク質を改変し、自然界の酵素を凌駕する高機能な酵素触媒の開発に取り組んでいます。<br>
研究内容の詳細は http://www.f.waseda.jp/akanuma/index.html でも確認できます。
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM akanuma';
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