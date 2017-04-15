<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

//require_once('/conf/coolFactor.php');
define('DB_SERVER', 'mysql475.db.sakura.ne.jp');
define('DB_USER', 'researchstudent');
define('DB_SALTY', '098098poi');
define('DB_NAME', 'researchstudent_sql');

/*
* pictに対するアクセスCLASS
*
*/
class DbPict{

    /*
     * pictに対する画像名pname、リンク名urlの追加
     *
     * @param 画像名$ret_pname
     * @output $url
     */
	public function registPictName($ret_pname){
	    $oid = 1;
	    $url = strrev($ret_pname);
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
INSERT INTO pict (pname, url ) VALUES ('{$ret_pname}', '{$url}')");
		if (!$result) {
			die('Insertクエリーが失敗しました'.  mysql_error());
		}
        //takes ID
		$id_result = mysql_query("SELECT id FROM pict");
		if (!$id_result) {
			die('last IDクエリーが失敗しました'.  mysql_error());
		}
		while($row = mysql_fetch_assoc($id_result)){
			//TODO
			//print_r($row);
			$arr_com = $row['id'];
			print('<hr>id=' . $row['id']);
			//print('<br>iid=' .  $arr_com[0]['iid']);
			//print('<br>cline=' . $row['cline']);
			//print('<br>cowner=' . $row['cowner']);
		}
        $last_id = $arr_com;
		mysql_close($link);
        //SELECT LAST_INSERT_ID()
       // $ret = array($last_id, $url);
        print '$last_id=';
  		print_r($last_id, false);
        print '<hr>';
        print '$url=' . $url;
		return  array($last_id, $url);
	}


    /*
     * 画像名pnameの要素取得
     *
     * @param クエリパラメータ$url
     * @output 要素配列？
     */
	public function pnameGet($url){
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
		//echo '<hr>URL='. $url;
		//$result = mysql_query('SELECT pname FROM pict WHERE url = "'.$url.'"');

		$result = mysql_query('SELECT pname FROM pict WHERE url = "'.$url.'"');
		//$result = mysql_query('SELECT pname FROM pict WHERE url = "yab"');
		if (!$result) {
			die('pnameGetクエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
		$arr_com = 'default';

		while($row = mysql_fetch_assoc($result)){
            //TODO
	  //echo 'Row=';
       //   print_r($row);
			$arr_com = $row['pname'];
		}
		return $arr_com;
	//func
	}

    /*
     * テーブルpictからの画像IDpidの取得
     *
     * @param クエリパラメータ$url
     * @output ＄pid
     */
	public function gidGet($url){
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
		//echo $url.'<hr>';
		$result = mysql_query('SELECT id FROM pict WHERE url = "'.$url.'"');
		//$result = mysql_query('SELECT pname FROM pict WHERE url = "yab"');
		if (!$result) {
			die('gidGetクエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
		$arr_com = 'default';
		while($row = mysql_fetch_assoc($result)){
			//TODO
			//print_r($row);
			$arr_com = $row['id'];
			//print('<hr>id=' . $row['id']);
			//print('<br>iid=' .  $arr_com[0]['iid']);
			//print('<br>cline=' . $row['cline']);
			//print('<br>cowner=' . $row['cowner']);
		}
		return $arr_com;
		//func
		}

    /*
     * テーブルpictからの画像名pnameの取得
     *
     * @param 画像ID$id
     * @output ＄pname
     */


	public function imageGet($id){
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
		$result = mysql_query("SELECT pname FROM pict WHERE id = $id");
		if (!$result) {
			die('imageGetクエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
        $arr_com = array();
		while($row = mysql_fetch_assoc($result)){
			//if ($row['pname'] == 'XXX') {
			//	throw new Exception ('「Exceptionって知ってる？<br>知らないよね。<br>じゃあいいや、気にしないでねｗ」');
			//}
			$arr_com[ ] = $row;
		}
        //print_r($arr_com);
		return $arr_com[0]['pname'];
	}

    /*
     * テーブルpictから全ての取得
     *
     * @param 画像ID$id
     * @output ＄pname
     */
	public function getPict($id){
		// MySQLに対する処理
		$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
		if (!$link) {
			die('接続失敗です。'.mysql_error());
		}
		$db_selected = mysql_select_db(DB_NAME, $link);
		if (!$db_selected){
			die('データベース選択失敗です。'.mysql_error());
		}
		mysql_set_charset('utf8');
		//$result = mysql_query("SELECT * FROM pict WHERE id = $id");
		$result = mysql_query("SELECT * FROM pict");
		if (!$result) {
			die('imageGetクエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
        $arr_com = array();
		while($row = mysql_fetch_assoc($result)){
			//if ($row['pname'] == 'XXX') {
			//	throw new Exception ('「Exceptionって知ってる？<br>知らないよね。<br>じゃあいいや、気にしないでねｗ」');
			//}
			$arr_com[ ] = $row;
		}
        //print_r($arr_com);
//		return $arr_com[0]['pname'];
		return $arr_com;

    //func
	}

//class
}
