<?php
//namespace Comment;

//require_once('/conf/coolFactor.php');

define('DB_SERVER', 'mysql475.db.sakura.ne.jp');
define('DB_NAME', 'researchstudent');
define('DB_SALTY', '098098poi');
define('TB_NAME', 'researchstudent_sql');

/*
 * コメントを受け付けて記録すること
 * @param コメント者名
 * @param 画像名称
 *
 */
class InviteComment {


	/*
     * コメントを受け付けること
     * @param form input
     *
     */
	public function receiveComment(){

    echo <<< EOM
<?php $url="http://researchstudent.sakura.ne.jp/sql/form.html";?>
<a href="javascript:window.open('<?php echo $url;?>', '', 'width=500,height=400');">新しいウィンドウ</a>
EOM;

    }
    /*
     * コメントを記録すること
     * @result DB storage
     */
	public function recordComment(){

    echo <<< EOM
EOM;
    <html> <head>
    <meta charset='utf-8'>
    <title>mysql insertion Comment</title> </head>
    <body>
    <!-- form.htmlでdbに書き込みの後読み出している。読み出し部分を使うとコメント表示が出来るはず。 -->
    <?php
    $link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
    if (!$link) {
    	die('接続失敗です。'.mysql_error());
    }
    $db_selected = mysql_select_db(TB_NAME, $link);
    if (!$db_selected){
    	die('データベース選択失敗です。'.mysql_error());
    }
    print('<p>データベースを選択しました。</p>');
    mysql_set_charset('utf8');
    $result = mysql_query('SELECT id,iid,cline,cowner FROM comment');
    if (!$result) {
    	die('SELECTクエリーが失敗しました。'.mysql_error());
    }
    while ($row = mysql_fetch_assoc($result))
    {
    	print('<p>');
    	print('id='.$row['id']);
    	print(',iid='.$row['iid']);
    	print(',cowner='.$row['cowner']);
    	print('</p>');
    }
    print('<p>データを追加します。</p>');

    $cowner = $_POST['take_owner'];
    $ccomment = $_POST['take_comment'];
    print('<p>cowner='.$cowner.'</p>');


    $sql = "INSERT INTO comment (iid,cline,cowner) VALUES (2, '$ccomment', '$cowner')";
    echo '<hr>' . $sql . '<hr>';
    $result_flag = mysql_query($sql);
    if (!$result_flag) { die('INSERTクエリーが失敗しました。'.mysql_error()); }
    print('<p>追加後のデータを取得します。</p>');

    $result = mysql_query('SELECT id,iid,cline,cowner FROM comment');
    if (!$result) {
    	die('SELECTクエリーが失敗しました。'.mysql_error());
    }
    while ($row = mysql_fetch_assoc($result)) {
    	print('<p>');
    	print('iid='.$row['iid']);
    	print(',cowner='.$row['cowner']);
    	print(',cline='.$row['cline']);
    	print('</p>');
    }
    $close_flag = mysql_close($link);
    if ($close_flag){ print('<p>切断に成功しました。</p>'); }
    ?>
     </body>

    }
}


