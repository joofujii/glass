<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

//require_once('/conf/coolFactor.php');
//define('DB_SERVER', 'mysql475.db.sakura.ne.jp');
//define('DB_USER', 'researchstudent');
//define('DB_SALTY', '098098poi');
//define('DB_NAME', 'researchstudent_sql');

/*
* commに対するアクセスCLASS
*
*/
class DbComm{

    /*
     * commテーブルの要素取得
     *
     * @param glass番号gid
     * @output 要素配列
     */
    public function dbGet($gid){
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
		//$result = mysql_query('SELECT * FROM comment');
		//$result = mysql_query('SELECT * FROM comm');
		$result = mysql_query('SELECT * FROM comm WHERE pid ="'.$gid.'"');
		if (!$result) {
			die('dbGetクエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
        $arr_com = array();
		while($row = mysql_fetch_assoc($result)){
			//$row = mysql_fetch_assoc($result);
			if ($row['writer'] == 'XXX') {
				throw new Exception ('「Exceptionって知ってる？<br>知らないよね。<br>じゃあいいや、気にしないでねｗ」');
			}
			$arr_com[ ] = $row;
		}
        return $arr_com;
	//func
    }

//class
}
