<html> <head> <title>PHP mysql insertion</title> </head>

<body>

<?php
$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
 if (!$link) {
 die('接続失敗です。'.mysql_error()); 
}
$db_selected = mysql_select_db('researchstudent_ci', $link);
//
 if (!$db_selected){
 die('データベース選択失敗です。'.mysql_error()); 
}


print('<p>データベースを選択しました。</p>');

mysql_set_charset('utf8');

$result = mysql_query('SELECT iname,iowner FROM image'); if (!$result) { die('SELECTクエリーが失敗しました。'.mysql_error()); }


while ($row = mysql_fetch_assoc($result))
{
    print('<p>');
    print('iname='.$row['iname']);
    print(',iowner='.$row['iowner']);
    print('</p>');
 }

print('<p>データを追加します。</p>');

$sql = "INSERT INTO image (iname,iowner) VALUES ('niceWeather', 'Linda')";
$result_flag = mysql_query($sql);

if (!$result_flag) { die('INSERTクエリーが失敗しました。'.mysql_error()); }

print('<p>追加後のデータを取得します。</p>');

$result = mysql_query('SELECT iname,iowner FROM image'); if (!$result) { die('SELECTクエリーが失敗しました。'.mysql_error()); }

while ($row = mysql_fetch_assoc($result)) { print('<p>'); print('iname='.$row['iname']); print(',iowner='.$row['iowner']); print('</p>'); }

$close_flag = mysql_close($link);

if ($close_flag){ print('<p>切断に成功しました。</p>'); }

?>
 </body>