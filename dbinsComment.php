<html> <head>
<meta charset='utf-8'>
<title>かきこ</title> </head>
<body>
<?php
//require_once('/conf/coolFactor.php');

define('DB_SERVER', 'mysql475.db.sakura.ne.jp');
define('DB_NAME', 'researchstudent');
define('DB_SALTY', '098098poi');
define('TB_NAME', 'researchstudent_sql');

$link = mysql_connect(DB_SERVER, DB_NAME, DB_SALTY);
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db(TB_NAME, $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
mysql_set_charset('utf8');

$cowner = $_POST['take_owner'];
$ccomment = $_POST['take_comment'];
$gid = $_POST['glass'];

//gidに対応する、いいねカウントを取得する。
//コメントの確認
if ($ccomment == 'いいね'){
    //いいね、ならばiineカウントを持ってくる。
    //$result = mysql_query('SELECT id,iine FROM glass');
    $result = mysql_query('SELECT id,iine FROM glass');
$array_iine = array();
while ($row = mysql_fetch_assoc($result))
{
    //TODO
    $iine_c = $row['iine'];
    //echo 'iine='.$iine_c.'=<hr>';
    array_push($array_iine, $iine_c);
    //$array_iine[] = $iine_c;
}
    //print_r($array_iine,false);
    //print '$array_iine='.$array_iine['6'];
    //echo '<div style="font-size:30pt">';
    $qid = $gid - 1;
    $iine_c = $array_iine[$qid];

    //カウントを増やす。
    $iine_c++;
    echo '$gid='.$gid.'=<hr>';
    echo '$iine_c='.$iine_c.'=<hr>';

    echo '<br>「いいね」だったので、いいねしときます！<br><br><br><br>';
    //echo '<br><br>コメントが書いてなかったですっ！<br><br><br><br>';
    
    //TODO
    //gidに対応するレコードにカウントを格納する。
    //$sql = "INSERT INTO glass (iine) VALUES ($iine_c)";

    $sql = "UPDATE glass SET iine = $iine_c WHERE id = $gid";
    //$sql = "UPDATE glass SET iine = $iine_c, oid = $oid  WHERE id = $gid";

    $result_flag = mysql_query($sql);
    if (!$result_flag) { die('UPDATクエリーが失敗しました。'.mysql_error()); }
    echo '<a href="#" onClick="window.close(); return false;">CLOSE</a>';
    echo '</div>';
}else{
    //コメントを該当するpidで登録する。
    $sql = "INSERT INTO comm (pid,comment,writer) VALUES ('$gid', '$ccomment', '$cowner')";
//    $sql = "INSERT INTO comm (pid,comment,writer) VALUES ('$gid', '$ccomment', '$cowner')";
    echo '<hr>sql=' . $sql . '<hr>';
    $result_flag = mysql_query($sql);
    if (!$result_flag) { die('INSERTクエリーが失敗しました。'.mysql_error()); }
    //print('<p>追加後のデータを取得します。</p>');
    echo '書いたよ<br><br>リロードしてみて<br><br><br><br>';
    echo '<a href="#" onClick="window.close(); return false;">CLOSE</a>';
    echo '</div>';
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
