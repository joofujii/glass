<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

// MySQLに対する処理
$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
 if (!$link) {
 die('接続失敗です。'.mysql_error()); 
}

$db_selected = mysql_select_db('researchstudent_ci', $link);
 if (!$db_selected){
 die('データベース選択失敗です。'.mysql_error()); 
}

$result = mysql_query('SELECT * FROM blog_data');
 if (!$result) {
 die('クエリーが失敗しました。'.mysql_error()); 
}

mysql_close($link);

echo 'end of DB access<br>id=';

$row = mysql_fetch_assoc($result);
 print($row['id']);
// print($row['name']);
echo '<br>end of DB show';

?>
