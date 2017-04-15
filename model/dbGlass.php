<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

//require_once('/conf/coolFactor.php');

//define('DB_SERVER', 'mysql475.db.sakura.ne.jp');
//define('DB_USER', 'researchstudent');
//define('DB_SALTY', '098098poi');
//define('DB_NAME', 'researchstudent_sql');

/*
* glassに対するアクセスCLASS
*
*/
class DbGlass{


    /*
     * glassに対する画像ID pid、owner名oidの追加
     *
     * @param 画像名$ret_pname
     * @output $url
     */
	public function registOwnerName($pid, $pname){
	    $oid = 1;
		// MySQLに対する処理
		$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
		if (!$link) {
			die('接続失敗です。'.mysql_error());
		}
		$db_selected = mysql_select_db('researchstudent_sql', $link);
		if (!$db_selected){
			die('データベース選択失敗です。'.mysql_error());
		}
		mysql_set_charset('utf8');
    // insert
		$result = mysql_query("
INSERT INTO glass (pid, oid) VALUES ('{$pid}', '{$oid}')");
//INSERT INTO pict (pname, url ) VALUES ('{$ret_pname}', '{$url}')");

		if (!$result) {
			die('Insertクエリーが失敗しました'.  mysql_error());
		}
    //takes ID
		$last_id = mysql_query("SELECT LAST_INSERT_ID()");
		if (!$last_id) {
			die('last IDクエリーが失敗しました'.  mysql_error());
		}
		mysql_close($link);
//SELECT LAST_INSERT_ID()
    $ret = $result;
		return  $ret;
	}

    /*
     * いいねカウントの取得
     *
     * @param glass番号gid
     * @output $iine
     */
    public function iineGet($gid)
    {
        // MySQLに対する処理
	$link = mysql_connect(DB_SERVER, DB_USER, '098098poi');
	if (!$link) {
	    die('接続失敗です。'.mysql_error());
	}
	$db_selected = mysql_select_db(DB_NAME, $link);
	if (!$db_selected){
	    die('データベース選択失敗です。'.mysql_error());
	}
	mysql_set_charset('utf8');
	$result = mysql_query('SELECT iine FROM glass WHERE id = "'.$gid.'"');
	mysql_close($link);
        $row = mysql_fetch_assoc($result);
        return $row['iine'];
	//func
	}

//class
}
