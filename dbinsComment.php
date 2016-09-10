<html> <head>
<meta charset='utf-8'>
 <title>かきこ</title> </head>
<body>
<?php
$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
 if (!$link) {
 die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db('researchstudent_ci', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
//print('<p>データベースを選択しました。</p>');
mysql_set_charset('utf8');
$result = mysql_query('SELECT id,iid,cline,cowner FROM comment');
if (!$result) {
	die('SELECTクエリーが失敗しました。'.mysql_error());
}
//while ($row = mysql_fetch_assoc($result))
//{
//    print('<p>');
//    print('id='.$row['id']);
//    print(',iid='.$row['iid']);
//    print(',cowner='.$row['cowner']);
//    print('</p>');
// }
//print('<p>データを追加します。</p>');

$cowner = $_POST['take_owner'];
$ccomment = $_POST['take_comment'];

if ($ccomment == 'こう思った'){
//	die('コメントが書いてなかったですっ！'.mysql_error());
	echo 'コメントが書いてなかったですっ！<br><br><br><br>';
	echo '<a href="#" onClick="window.close(); return false;">CLOSE</a>';
}
else{
	$sql = "INSERT INTO comment (iid,cline,cowner) VALUES (2, '$ccomment', '$cowner')";
	//echo '<hr>' . $sql . '<hr>';

	$result_flag = mysql_query($sql);
	if (!$result_flag) { die('INSERTクエリーが失敗しました。'.mysql_error()); }
	//print('<p>追加後のデータを取得します。</p>');
	echo '書いたよ<br><br>リロードしてみて<br><br><br><br>';
	echo '<a href="#" onClick="window.close(); return false;">CLOSE</a>';

}
//$result = mysql_query('SELECT id,iid,cline,cowner FROM comment');
//if (!$result) {
//	die('SELECTクエリーが失敗しました。'.mysql_error());
//}
//while ($row = mysql_fetch_assoc($result)) {
//	print('<p>');
//    print('iid='.$row['iid']);
//    print(',cowner='.$row['cowner']);
//    print('</p>');
//}
$close_flag = mysql_close($link);
//if ($close_flag){ print('<p>切断に成功しました。</p>'); }
?>
 </body>
