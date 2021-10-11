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
        $sql  = 'INSERT INTO asada (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/3-4-1asada.php');
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
    <title>浅田ゼミの口コミページ</title>
    <link rel="stylesheet" href="/../style.css">
    <link rel="stylesheet" href="/../kuchikomi.css">
</head>
<body>

<div id="wrapper">
<a href="/../index.html"><input type="button" value="トップへ戻る" id="backBtn"></a>
<h1>浅田ゼミの口コミページ</h1>
<div class="container" id="about">
<h2>研究内容</h2>
<div id="description">
<h3>キーワード</h3>
<h4>学校学習システム，教師の成長，教師のわざ，子どもの自己概念，メンタリング，アクションリサーチ，学校と大学との連携，防災教育，教師の意思決定</h4>
<hr>
<p>
人間の成長発達において学校学習の役割はきわめて大きい。<br>
このことを踏まえ，学校教育を中心とした以下のようなテーマから，教育が人間の成長発達に果たす役割を探求する。<br>
①教える専門家としての教師が授業に関する知識（実践知あるいは暗黙知）をどのように獲得し，<br>
またどのように実践に活用しているかを明らかにする。<br>
また，教師の「わざ」や看護における「わざ」の研究を行っている。<br>
現在は，教師の意思決定を中心に研究を行う。また，幼稚園での机上シミュレーションによる研究も行う。<br>
② ①に関連して，教師同士がどのように学び合うか，あるいは経験教師が若手教師をどのように育てるか，<br>
について研究を進めている。具体的には，初任者研修や校内研修（lesson study）の分析を行っている。<br>
③大学と学校との協働（ネットワーク）として，小学校での学生ボランティア活動を行いながら，<br>
その活動が現場の教育の質を高めることにどのように役立つかを探っている。<br>
④教育研究の1つのあり方としてアクションリサーチを取り上げ，学校や教師を対象とするだけでなく，<br>
専門家が自ら成長していくアプローチとしてのアクションリサーチを探究している。<br>
⑤デジタル教科書，ＶＲや拡張現実を活用した実験的取り組みを進めている。<br>
具体的には，和歌山県湯浅町，日本赤十字看護大，扇原研究室との協働で防災教育プロジェクトを進めている。<br>
Web page:http://asadalabmembers.wixsite.com/asdlab/research<br>
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM asada';
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