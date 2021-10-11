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
        $sql  = 'INSERT INTO katoShigeo (name, comment) VALUES (:NAMAE, :COMMENT)';
        $stmt = $dbh->prepare($sql);
        $params = array(':NAMAE' => $_POST['name'], ':COMMENT' => $_POST['comment']); // 挿入する値を配列に格納する
        $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行

        header('location: http://localhost:5501/professors_file/1-3-1kato.php');
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
<h4>科学史、技術史、思想史</h4>
<hr>
<p>
科学を対象として、歴史学的研究を行っている。<br>
本研究室が求めているのは、科学研究に関わった人間の思想や行動を、その紆余曲折や袋小路、そして退路にも丁寧に寄り添いながら、<br>
文化・社会・政治などとの複雑な相互関係のなかに置いて多角的な視点から見極め、それを通じて人間についての理解を広げ深めることである。<br>
私は私一人の人生しか送れない。<br>
しかし、過去の科学者について歴史的に検討することにより、多くの生き方を知り、自分が生きる参考にすることができる。<br>
私は現在に生きる以上、現在の見方に束縛されることは免れえないのだが、<br>
過去の声に真摯に耳を傾け、現在中心主義的ではない知の歴史を考え、自己を過去の他者に開くことを試みたいと思っている。<br>
本研究室は近代東アジア科学史を中心として研究しているが、学生の研究テーマはその分野に限定しない。<br>
科学史・科学哲学・科学社会学などに関する研究を認めている。
</p>
</div>
</div>

<div id="list-area">

<?php
// 口コミリスト一覧    
$sql    = 'SELECT * FROM katoShigeo';
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